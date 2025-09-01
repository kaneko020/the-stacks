<template>
    <div class="content-card">
        <div class="content-image">
            <img :src="`/contents/${content.image_url}`" :alt="content.title" />
        </div>
    </div>
</template>

<script setup lang="ts">
import type { Content } from '../types';

interface Props {
    content: Content;
}

defineProps<Props>();
</script>

<style scoped>
.content-card {
    border-radius: 8px;
    transition: transform 0.2s, box-shadow 0.2s, scale 0.2s;
    display: flex;
}

.content-card:hover {
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.562);
    scale: 1.05;
}

.content-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 5px;
}
</style>
