<template>
    <aside class="app-sidebar">
        <nav class="sidebar-nav">
            <router-link to="/" class="nav-link">HOME</router-link>

            <CategoryComponent  @selected-category="selectCategory" />
        </nav>
    </aside>
</template>

<script setup lang="ts">
import type { Category } from '../types';
import CategoryComponent from './CategoryComponent.vue';

const emit = defineEmits<{
    selectedCategory: [category: Category];
}>();

const selectCategory = (category: Category) => {
    emit('selectedCategory', category);
};
</script>

<style scoped>
.app-sidebar {
    position: fixed;
    left: 0;
    top: 64px; /* ヘッダーの高さに合わせて調整 */
    bottom: 0;
    width: 250px;
    background-color: var(--bg-navy);
    box-shadow: 2px 0 5px 1px rgba(157, 183, 255, 0.3);
    padding: 15px 0;
    z-index: 100;
    transition: transform 0.3s ease;
    overflow-y: auto;
}

.sidebar-nav {
    display: flex;
    flex-direction: column;
    margin-top: 5px;
    padding: 0 15px;
}

.nav-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: var(--text-light);
    padding: 0.75rem 1rem;
    margin-bottom: 0.5rem;
    border-radius: 4px;
    transition: all 0.2s ease;
    gap: 0.5rem;
}

.nav-link:hover {
    background-color: var(--hover-bg);
    color: #ffffff;
}

.router-link-active {
    font-weight: bold;
    color: #ffffff;
    border: 2px solid rgb(0, 26, 255);
    background-color: rgba(80, 89, 177, 0.342);
}
</style>
