<script setup lang="ts">
import type { NavItem } from '@/types';

defineProps<{
    items: NavItem[];
}>();
</script>

<template>
    <nav class="nav flex-column px-3 py-2">
        <div class="list-group list-group-flush">
            <a v-for="item in items" :key="item.title" :href="item.href" class="list-group-item list-group-item-action" target="_blank">
                <i v-if="item.icon" :class="item.icon" class="me-2"></i>
                {{ item.title }}
            </a>
        </div>
    </nav>
</template>

<style scoped>
.list-group-item {
    border: none;
    padding: 0.5rem 1rem;
}
.list-group-item:hover {
    background-color: #e9ecef;
}
</style>
