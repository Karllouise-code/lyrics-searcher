<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const query = ref('');
const result = ref<{ artist: string; title: string; lyrics: string } | null>(null);
const suggestions = ref<{ artist: string; title: string }[]>([]);
const error = ref<string | null>(null);

const user = usePage().props.auth?.user;

const search = async () => {
    error.value = null;
    suggestions.value = [];
    const parts = query.value.trim().split(' ');
    const artist = parts[0];
    const title = parts.slice(1).join(' ');

    if (!artist || !title) {
        error.value = 'Please enter both artist and title';
        return;
    }

    try {
        const { data } = await axios.get(`/api/get-lyrics?artist=${encodeURIComponent(artist)}&title=${encodeURIComponent(title)}`);
        if (data.lyrics) {
            result.value = { artist, title, lyrics: data.lyrics };
        } else {
            error.value = 'Lyrics not found';
            result.value = null;
        }
    } catch {
        error.value = 'Error fetching lyrics';
        result.value = null;
    }

    try {
        const { data } = await axios.post('/graphql', {
            query: `
                query ($query: String!) {
                    suggestions(query: $query) {
                        artist
                        title
                    }
                }
            `,
            variables: { query: query.value },
        });
        suggestions.value = data.data.suggestions;
    } catch {
        suggestions.value = [];
    }
};

const addToFavorites = async () => {
    if (!result.value) return;
    if (!user) {
        error.value = 'Please log in to add favorites';
        return;
    }
    try {
        await axios.post('/graphql', {
            query: `
                mutation ($artist: String!, $title: String!) {
                    addFavorite(artist: $artist, title: $title) {
                        id
                        artist
                        title
                    }
                }
            `,
            variables: { artist: result.value.artist, title: result.value.title },
        });
    } catch (e: any) {
        error.value = e.message.includes('authorization') ? 'Please log in to add favorites' : 'Error adding to favorites';
    }
};
</script>

<template>
    <Head title="Searchsda" />

    <AppLayout :breadcrumbs="[{ title: 'Search', href: '/' }]">
        <div class="container py-4">
            <h1 class="mb-3">LyriSearch</h1>
            <form @submit.prevent="search" class="mb-4">
                <div class="input-group">
                    <input
                        v-model="query"
                        type="text"
                        class="form-control form-control-lg"
                        placeholder="Enter artist and title (e.g., Adele Hello)"
                        aria-label="Search lyrics"
                    />
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
            <div v-if="error" class="alert alert-danger" role="alert">
                {{ error }}
            </div>
            <div v-if="suggestions.length" class="mb-4">
                <h3>Suggestions</h3>
                <ul class="list-group">
                    <li v-for="suggestion in suggestions" :key="`${suggestion.artist}-${suggestion.title}`" class="list-group-item">
                        {{ suggestion.artist }} - {{ suggestion.title }}
                    </li>
                </ul>
            </div>
            <div v-if="result" class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ result.artist }} - {{ result.title }}</h5>
                    <pre class="card-text">{{ result.lyrics }}</pre>
                    <button class="btn btn-primary" :disabled="!user" @click="addToFavorites">Add to Favorites</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
