<script setup lang="ts">
defineProps<{
    breadcrumbs?: { title: string; href: string }[];
}>();
</script>

<template>
    <header class="d-flex align-items-center border-bottom p-3">
        <button
            class="btn btn-outline-secondary d-lg-none me-2"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#sidebar"
            aria-controls="sidebar"
        >
            <i class="bi bi-list"></i>
        </button>
        <nav v-if="breadcrumbs && breadcrumbs.length > 0" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li v-for="item in breadcrumbs" :key="item.href" class="breadcrumb-item">
                    <a :href="item.href">{{ item.title }}</a>
                </li>
            </ol>
        </nav>
    </header>
</template>
