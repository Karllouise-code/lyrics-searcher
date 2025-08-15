<script setup lang="ts">
defineProps<{
    variant?: 'header' | 'sidebar';
    class?: string;
}>();
</script>

<template>
    <main class="container flex-grow-1 py-4" :class="class">
        <slot />
    </main>
</template>
