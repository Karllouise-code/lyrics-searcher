<script setup lang="ts">
defineProps<{
    variant?: 'header' | 'sidebar';
}>();
</script>

<template>
    <div class="d-flex flex-column min-vh-100">
        <slot />
    </div>
</template>
