<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>
    <div v-if="message" class="text-danger small mt-1">
        {{ message }}
    </div>
</template>
