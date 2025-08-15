<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="d-flex flex-column min-vh-100 align-items-center justify-content-center p-4">
        <div class="w-100" style="max-width: 400px">
            <div class="mb-4 text-center">
                <Link :href="route('search')" class="d-flex flex-column align-items-center gap-2">
                    <div class="d-flex align-items-center justify-content-center mb-1" style="width: 48px; height: 48px">
                        <!-- <AppLogoIcon class="bi bi-music-note" style="width: 36px; height: 36px" /> -->
                        <AppLogoIcon class="size-9" style="width: 36px; height: 36px" />
                    </div>
                    <span class="visually-hidden">{{ title }}</span>
                </Link>
                <h1 class="h4 mb-2">{{ title }}</h1>
                <p class="small text-muted">{{ description }}</p>
            </div>
            <div class="card">
                <div class="card-body">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
