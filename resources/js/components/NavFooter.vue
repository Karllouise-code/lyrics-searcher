<template>
    <footer class="bg-light mt-4 py-4 text-center">
        <div class="container">
            <p>&copy; {{ new Date().getFullYear() }} Lyrics Searcher</p>
            <ul v-if="items.length" class="list-inline mt-2">
                <li v-for="item in items" :key="item.title" class="list-inline-item">
                    <a :href="item.href" target="_blank" rel="noopener noreferrer" class="text-primary">
                        <i v-if="item.icon" :class="item.icon" class="me-1"></i>
                        {{ item.title }}
                    </a>
                </li>
            </ul>
        </div>
    </footer>
</template>

<script setup lang="ts">
import type { NavItem } from '@/types';

interface Props {
    items?: NavItem[];
    class?: string;
}

defineProps<Props>();
</script>
