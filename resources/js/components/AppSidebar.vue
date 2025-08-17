<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import { Link, useForm } from '@inertiajs/vue3';

const navItems = [
    { title: 'Search', href: '/', icon: 'bi bi-search' },
    { title: 'Favorites', href: '/favorites', icon: 'bi bi-heart-fill', protected: true },
    { title: 'Dashboard', href: '/dashboard', icon: 'bi bi-house', protected: true },
];

const footerItems = [
    { title: 'GitHub', href: 'https://github.com/Karllouise-code/lyrics-searcher', icon: 'bi bi-github' },
    { title: 'Twitter', href: 'https://twitter.com/karl_rito', icon: 'bi bi-twitter' },
];

const form = useForm({});

const logout = () => {
    form.post(route('logout'), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <div class="offcanvas offcanvas-start d-lg-block" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">
                <Link :href="route('search')">
                    <AppLogoIcon style="width: 36px; height: 36px" />
                    <span class="ms-2">LyriSearch</span>
                </Link>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0" style="height: 80%">
            <NavMain :items="navItems" variant="sidebar" />
            <div class="mt-auto">
                <NavFooter :items="footerItems" />
            </div>
        </div>
        <div class="p-3">
            <button class="btn btn-danger w-100" :disabled="form.processing" @click="logout">Log Out</button>
        </div>
    </div>
</template>

<style scoped>
.offcanvas {
    width: 300px !important;
}
@media (min-width: 992px) {
    .offcanvas {
        position: fixed;
        top: 0;
        bottom: 0;
        z-index: 100;
        transform: none;
        visibility: visible;
    }
}
</style>
