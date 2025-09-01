<template>
    <div class="app-container">
        <AppHeader />
        <AppSidebar @selected-category="selectCategory" />

        <main class="app-content">
            <router-view></router-view>
        </main>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import type { Category } from '../types';
import AppHeader from './AppHeader.vue';
import AppSidebar from './AppSidebar.vue';

// 選択されたカテゴリーIDを管理
const selectedCategory = ref<Category | null>(null);

// カテゴリー選択のハンドラー
const selectCategory = (category: Category) => {
    selectedCategory.value = category;
};
</script>

<style>
/* グローバルスタイル */
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
}

/* アプリケーション全体のスタイル */
.app-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.app-nav {
    margin-top: 1rem;
    display: flex;
    gap: 1rem;
}

.nav-link {
    text-decoration: none;
    color: #e9e9e9;
    padding: 0.5rem 0.75rem;
    border-radius: 4px;
    transition: all 0.2s;
}

/* メインコンテンツのスタイル */
.app-content {
    flex: 1;
    margin-left: 250px; /* サイドバーの幅と同じ */
    transition: margin-left 0.3s ease;
    background-color: var(--bg-light);
}
</style>
