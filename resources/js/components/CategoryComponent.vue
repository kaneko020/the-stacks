<template>
    <div class="sidebar-section">
        <h3 class="section-title">カテゴリー</h3>
        <div v-if="loading" class="loading">読み込み中...</div>
        <div v-else-if="error" class="error">{{ error }}</div>
        <div v-else-if="categories.length === 0" class="no-categories">
            カテゴリーがありません
        </div>
        <div v-else>
            <router-link
                v-for="category in categories" 
                :key="category.id"
                :to="{
                    name: 'category',
                    params: { id: category.id }
                }"
                @click="selectCategory(category)"
                class="nav-link"
            >
                <span class="category-name">{{ category.name }}</span>
                <span class="content-count">({{ category.contents_count }})</span>
            </router-link>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import type { Category } from '../types';

const emit = defineEmits<{
    selectedCategory: [category: Category];
}>();

// リアクティブデータ
const categories = ref<Category[]>([]);
const loading = ref(true);
const error = ref<string | null>(null);

// カテゴリーを取得する関数
const fetchCategories = async () => {
    try {
        loading.value = true;
        error.value = null;

        const response = await axios.get('/api/category');
        categories.value = response.data;
        
        console.log('取得したカテゴリー:', response.data);
    } catch (err: any) {
        console.error('カテゴリーの取得に失敗しました:', err);
        error.value = err.response?.data?.message || err.message || 'カテゴリーの取得に失敗しました';
    } finally {
        loading.value = false;
    }
};

// カテゴリー選択処理
const selectCategory = (category: Category) => {
    console.log('カテゴリーが選択されました:', category);
    emit('selectedCategory', category);
};

onMounted(() => {
    fetchCategories();
});
</script><style scoped>
.app-sidebar {
    position: fixed;
    left: 0;
    top: 64px; /* ヘッダーの高さに合わせて調整 */
    bottom: 0;
    width: 250px;
    background-color: var(--bg-navy);
    box-shadow: 2px 0 5px 1px rgba(157, 183, 255, 0.3);
    padding: 20px 0;
    z-index: 100;
    transition: transform 0.3s ease;
    overflow-y: auto;
}

.sidebar-nav {
    display: flex;
    flex-direction: column;
    margin-top: 5px;
    padding: 0 20px;
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
    cursor: pointer;
}

.nav-link:hover {
    background-color: var(--hover-bg);
    color: #ffffff;
}

.nav-link.active,
.router-link-active {
    font-weight: bold;
    color: #ffffff;
    border: 2px solid rgb(0, 26, 255);
    background-color: rgba(80, 89, 177, 0.342);
}

.sidebar-section {
    margin-top: 2rem;
}

.section-title {
    color: #a0a0a0;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.75rem;
    padding: 0 1rem;
}

.category-name {
    flex: 1;
}

.content-count {
    font-size: 0.875rem;
    color: #a0a0a0;
    background-color: rgba(255, 255, 255, 0.1);
    padding: 0.125rem 0.5rem;
    border-radius: 12px;
}

.loading, .error, .no-categories {
    color: #a0a0a0;
    text-align: center;
    padding: 1rem;
    font-size: 0.875rem;
}

.error {
    color: #ff6b6b;
}
</style>
