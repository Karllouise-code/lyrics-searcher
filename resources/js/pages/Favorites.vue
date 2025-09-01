<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const favorites = ref<{ id: number; artist: string; title: string }[]>([]);
const error = ref<string | null>(null);

const fetchFavorites = async () => {
    try {
        const { data } = await axios.post('/graphql', {
            query: `
                query {
                    favorites {
                        id
                        artist
                        title
                    }
                }
            `,
        });

        if (data.errors) {
            error.value = data.errors[0].message;
            favorites.value = [];
        } else {
            favorites.value = data.data.favorites;
        }
    } catch (e: any) {
        // error.value = e.message.includes('authorization') ? 'Please log in to view favorites' : 'Error fetching favorites';
        error.value = 'Error fetching favorites';
    }
};

const removeFavorite = async (id: number) => {
    try {
        const { data } = await axios.post('/graphql', {
            query: `
                mutation ($id: ID!) {
                    removeFavorite(id: $id) {
                        id
                    }
                }
            `,
            variables: { id },
        });
        if (data.errors) {
            error.value = data.errors[0].message;
        } else {
            favorites.value = favorites.value.filter((fav) => fav.id !== id);
            error.value = 'Removed from favorites';
        }
    } catch {
        error.value = 'Error removing favorite';
    }
};

fetchFavorites();
</script>

<template>
    <Head title="Favorites" />
    <AppLayout :breadcrumbs="[{ title: 'Favorites', href: '/favorites' }]">
        <div class="container py-4">
            <h1 class="mb-3">Favorites</h1>
            <div
                v-if="error"
                class="alert"
                :class="{ 'alert-danger': error !== 'Removed from favorites', 'alert-success': error === 'Removed from favorites' }"
                role="alert"
            >
                {{ error }}
            </div>
            <div v-if="favorites.length" class="row g-4">
                <div v-for="fav in favorites" :key="fav.id" class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <template v-if="fav.artist && fav.artist !== 'Unknown Artist'">{{ fav.artist }}</template>
                                <template v-if="fav.artist && fav.artist !== 'Unknown Artist' && fav.title"> - </template>
                                <template v-if="fav.title">{{ fav.title }}</template>
                            </h5>
                            <button class="btn btn-danger btn-sm" @click="removeFavorite(fav.id)">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="alert alert-info" role="alert">No favorites yet.</div>
        </div>
    </AppLayout>
</template>
