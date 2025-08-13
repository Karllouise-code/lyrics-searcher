<template>
    <div class="d-flex flex-column min-vh-100">
        <NavMain :items="navItems" />
        <div class="container flex-grow-1 py-4">
            <h1 class="mb-3">Favorites</h1>
            <ul class="list-group">
                <li v-for="fav in favorites" :key="fav.id" class="list-group-item">
                    {{ fav.title }} by {{ fav.artist }}
                    <button class="btn btn-sm btn-danger float-end" disabled>Remove</button>
                </li>
            </ul>
            <div v-if="!favorites.length" class="alert alert-info mt-3">No favorites added yet.</div>
        </div>
        <NavFooter :items="footerItems" />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import NavFooter from '../components/NavFooter.vue';
import NavMain from '../components/NavMain.vue';

const navItems = [
    { title: 'Search', href: '/', icon: 'bi bi-search' },
    { title: 'Favorites', href: '/favorites', icon: 'bi bi-heart-fill' },
];

const footerItems = [
    { title: 'GitHub', href: 'https://github.com/Karllouise-code/lyrics-searcher', icon: 'bi bi-github' },
    { title: 'Twitter', href: 'https://twitter.com/karl_rito', icon: 'bi bi-twitter' },
];

// Mock data for favorites
const favorites = ref([
    { id: 1, artist: 'Adele', title: 'Hello' },
    { id: 2, artist: 'The Beatles', title: 'Hey Jude' },
]);
</script>
