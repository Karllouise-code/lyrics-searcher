<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import NavMain from '@/components/NavMain.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps<{
    breadcrumbs?: { title: string; href: string }[];
}>();

const user = usePage().props.auth?.user;
const appName = computed(() => import.meta.env.VITE_APP_NAME || 'LyriSearch');

const navItems = [
    { title: 'Search', href: '/', icon: 'bi bi-search' },
    { title: 'Favorites', href: user ? '/favorites' : '/login', icon: 'bi bi-heart-fill' },
    { title: 'Dashboard', href: user ? '/dashboard' : '/login', icon: 'bi bi-house' },
];
</script>

<template>
    <Head title="LyriSearch" />
    <AppShell variant="sidebar">
        <div v-if="user">
            <AppSidebar />
        </div>
        <div v-else>
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <div class="container">
                    <a class="navbar-brand" :href="route('search')">
                        <AppLogoIcon style="width: 24px; height: 24px" />
                        <span class="ms-2">{{ appName }}</span>
                    </a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="navbarNav">
                        <NavMain :items="navItems" />
                    </div>
                </div>
            </nav>
        </div>
        <AppContent variant="sidebar" class="mt-3">
            <!-- <AppSidebarHeader v-if="user" :breadcrumbs="breadcrumbs" /> -->
            <slot />
        </AppContent>
    </AppShell>
</template>
