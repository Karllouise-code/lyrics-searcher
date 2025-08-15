<script setup lang="ts">
import type { NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps<{
    items: NavItem[];
    variant?: 'sidebar' | 'navbar';
}>();

const page = usePage();
const appName = computed(() => import.meta.env.VITE_APP_NAME || 'LyriSearch');
</script>

<template>
    <nav v-if="variant === 'sidebar'" class="nav flex-column">
        <!-- <div class="mb-3 px-3">
            <a class="navbar-brand" :href="route('search')">{{ appName }}</a>
        </div> -->
        <div class="list-group list-group-flush">
            <Link
                v-for="item in items"
                :key="item.title"
                :href="item.href"
                class="list-group-item list-group-item-action"
                :class="{ active: item.href === page.url }"
            >
                <i v-if="item.icon" :class="item.icon" class="me-2"></i>
                {{ item.title }}
            </Link>
        </div>
    </nav>

    <ul v-else class="navbar-nav">
        <li v-for="item in items" :key="item.title" class="nav-item">
            <Link :href="item.href" class="nav-link" :class="{ active: item.href === page.url }">
                <i v-if="item.icon" :class="item.icon" class="me-1"></i>
                {{ item.title }}
            </Link>
        </li>
    </ul>
</template>

<style scoped>
.navbar-brand {
    font-size: 1.25rem;
    font-weight: 500;
}
.list-group-item {
    border: none;
    padding: 0.5rem 1rem;
}
.list-group-item.active {
    background-color: #e9ecef;
    color: #212529;
}
</style>
