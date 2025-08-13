<template>
    <div class="d-flex flex-column min-vh-100">
        <NavMain :items="navItems" />
        <div class="container flex-grow-1 py-4">
            <h1 class="mb-3">Lyrics Searcher</h1>
            <div class="input-group mb-3">
                <input
                    v-model="query"
                    @input="suggest"
                    @keyup.enter="search"
                    type="text"
                    class="form-control"
                    placeholder="Search lyrics (e.g., Adele Hello)"
                    aria-label="Search lyrics"
                />
                <button @click="search" class="btn btn-primary text-white">Search</button>
            </div>
            <ul v-if="suggestions.length" class="list-group mb-3" style="max-height: 200px; overflow-y: auto">
                <li v-for="sug in suggestions" :key="sug.id" class="list-group-item list-group-item-action" @click="selectSuggestion(sug)">
                    {{ sug.title }} by {{ sug.artist }}
                </li>
            </ul>
            <div v-if="result" class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ result.title }} by {{ result.artist }}</h3>
                    <p class="card-text" style="white-space: pre-wrap">{{ result.lyrics }}</p>
                    <button disabled class="btn btn-success">Add to Favorites</button>
                </div>
            </div>
            <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
        </div>
        <NavFooter :items="footerItems" />
    </div>
</template>

<script setup>
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import Fuse from 'fuse.js';
import debounce from 'lodash.debounce';
import { ref } from 'vue';

const navItems = [
    { title: 'Search', href: '/', icon: 'bi bi-search' },
    { title: 'Favorites', href: '/favorites', icon: 'bi bi-heart-fill' },
];

const footerItems = [
    { title: 'GitHub', href: 'https://github.com/Karllouise-code/lyrics-searcher', icon: 'bi bi-github' },
    { title: 'Twitter', href: 'https://twitter.com/karl_rito', icon: 'bi bi-twitter' },
];

// Mock data for suggestions and results (replace with GraphQL later)
const mockSuggestions = [
    { id: 1, artist: 'Adele', title: 'Hello' },
    { id: 2, artist: 'Adele', title: 'Rolling in the Deep' },
    { id: 3, artist: 'The Beatles', title: 'Hey Jude' },
    { id: 4, artist: 'Ed Sheeran', title: 'Shape of You' },
];

const mockResult = {
    id: 1,
    artist: 'Adele',
    title: 'Hello',
    lyrics: `Hello, it's me\nI was wondering if after all these years you'd like to meet\nTo go over everything\nThey say that time's supposed to heal ya\nBut I ain't done much healing...`,
};

const query = ref('');
const suggestions = ref([]);
const result = ref(null);
const error = ref(null);

// Auto-suggest (mocked)
/* const suggest = () => {
    if (query.value.length < 3) {
        suggestions.value = [];
        return;
    }

    // Simple client-side filtering for mock suggestions
    suggestions.value = mockSuggestions.filter(
        (sug) => sug.title.toLowerCase().includes(query.value.toLowerCase()) || sug.artist.toLowerCase().includes(query.value.toLowerCase()),
    );

    if (!suggestions.value.length) {
        error.value = 'No suggestions found';
    } else {
        error.value = null;
    }
}; */

const fuse = new Fuse(mockSuggestions, {
    keys: ['artist', 'title'],
    threshold: 0.3,
});
const suggest = debounce(() => {
    // Existing suggest logic
    if (query.value.length < 3) {
        suggestions.value = [];
        return;
    }

    // Simple client-side filtering for mock suggestions
    /*  suggestions.value = mockSuggestions.filter(
        (sug) => sug.title.toLowerCase().includes(query.value.toLowerCase()) || sug.artist.toLowerCase().includes(query.value.toLowerCase()),
    );

    if (!suggestions.value.length) {
        error.value = 'No suggestions found';
    } else {
        error.value = null;
    } */
    suggestions.value = fuse.search(query.value).map((result) => result.item);
    error.value = suggestions.value.length ? null : 'No suggestions found';
}, 300);

// Search (mocked)
const search = () => {
    error.value = null;
    suggestions.value = [];

    const parts = query.value.trim().split(' ');
    const artist = parts[0];
    const title = parts.slice(1).join(' ');

    if (!artist || !title) {
        error.value = 'Please enter both artist and title';
        return;
    }

    if (artist.toLowerCase() === mockResult.artist.toLowerCase() && title.toLowerCase() === mockResult.title.toLowerCase()) {
        result.value = mockResult;
    } else {
        error.value = 'Lyrics not found';
        result.value = null;
    }
};

const selectSuggestion = (suggestion) => {
    query.value = `${suggestion.artist} ${suggestion.title}`;
    suggestions.value = [];
    search();
};
</script>
