<template>
    <div class="content-list">
        <div v-if="loading" class="loading">
            <div class="loading-spinner"></div>
            <p>コンテンツを読み込み中...</p>
        </div>
        <div v-else>
            <div v-if="error" class="error">
                <p>{{ error }}</p>
                <button @click="fetchContents()" class="retry-btn">再試行</button>
            </div>
            
            <div class="section-header">
                <h2 class="section-title">{{ category.name }}</h2>
                <button class="add-content-btn">
                    <fa icon="plus" />
                    追加
                </button>
            </div>
            <div class="filter-controls">
                <div class="search-container">
                    <fa icon="search" class="search-icon" />
                    <input 
                        type="text" 
                        v-model="searchQuery" 
                        placeholder="タイトルや作者名で検索" 
                        class="search-input" 
                        @input="filterContents"
                    />
                </div>
                <div class="sort-container">
                    <label for="sort-select">並び替え: </label>
                    <select id="sort-select" v-model="sortOption" @change="filterContents" class="sort-select">
                        <option :value="SortOption.ID_ASC"></option>
                        <option :value="SortOption.TITLE_ASC">タイトル（昇順）</option>
                        <option :value="SortOption.TITLE_DESC">タイトル（降順）</option>
                        <option :value="SortOption.AUTHOR_ASC">作者（昇順）</option>
                        <option :value="SortOption.AUTHOR_DESC">作者（降順）</option>
                        <option :value="SortOption.RATING_DESC">評価（高い順）</option>
                        <option :value="SortOption.RATING_ASC">評価（低い順）</option>
                    </select>
                </div>
                <div class="filter-container">
                    <input type="checkbox" v-model="showFavoritesOnly" @change="filterContents" />
                    <label>お気に入りのみ表示</label>
                </div>
            </div>
            <div class="content-grid">
                <ContentCard 
                    v-for="content in filteredContents" 
                    :key="content.id"
                    :content="content"
                />
            </div>
            <div v-if="filteredContents.length === 0 && !loading && !error" class="no-results">
                <p>該当するコンテンツがありません</p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';
import axios from 'axios';
import type { Category, Content } from '../types';
import { SortOption } from '../types';
import ContentCard from './ContentCard.vue';

interface Props {
    categoryId: number;
}

const props = defineProps<Props>();

const category = ref<Category | null>(null);
const contents = ref<Content[]>([]);
const filteredContents = ref<Content[]>([]);
const loading = ref(false);
const error = ref<string | null>(null);
const searchQuery = ref('');
const sortOption = ref<SortOption>(SortOption.ID_ASC);
const showFavoritesOnly = ref(false);

// コンテンツをフィルタリングする関数
const filterContents = () => {
    let result = [...contents.value];
    
    // お気に入りフィルタリング
    if (showFavoritesOnly.value) {
        result = result.filter(content => content.is_favorite);
    }
    
    // 検索フィルタリング
    if (searchQuery.value.trim()) {
        const query = searchQuery.value.toLowerCase();
        result = result.filter(content => 
            content.title.toLowerCase().includes(query) || 
            (content.author && content.author.toLowerCase().includes(query))
        );
    }
    
    // ソート
    switch(sortOption.value) {
        case SortOption.TITLE_ASC:
            result.sort((a, b) => a.title.localeCompare(b.title));
            break;
        case SortOption.TITLE_DESC:
            result.sort((a, b) => b.title.localeCompare(a.title));
            break;
        case SortOption.RATING_DESC:
            result.sort((a, b) => b.rating - a.rating);
            break;
        case SortOption.RATING_ASC:
            result.sort((a, b) => a.rating - b.rating);
            break;
        case SortOption.AUTHOR_ASC:
            result.sort((a, b) => {
                if (!a.author || !b.author) return 0;
                return a.author.localeCompare(b.author);
            });
            break;
        case SortOption.AUTHOR_DESC:
            result.sort((a, b) => {
                if (!a.author || !b.author) return 0;
                return b.author.localeCompare(a.author);
            });
            break;
        default:
            result.sort((a, b) => a.id - b.id);
            break;
    }
    
    filteredContents.value = result;
};

// コンテンツを取得する関数
const fetchContents = async () => {
    console.log("カテゴリーID:", props.categoryId);
    if (!props.categoryId) {
        contents.value = [];
        filteredContents.value = [];
        return;
    }

    try {
        loading.value = true;
        error.value = null;
        
        // カテゴリーの詳細情報を取得（contentsも含む）
        const response = await axios.get(`/api/category/${props.categoryId}`);
        console.log('取得したデータ:', response.data);
        
        category.value = response.data;
        contents.value = response.data.contents;
        
        // フィルタリングを適用
        filterContents();
    } catch (err: any) {
        console.error('コンテンツの取得エラー:', err);
        error.value = err.response?.data?.message || err.message || 'コンテンツの取得に失敗しました';
        contents.value = [];
        filteredContents.value = [];
    } finally {
        loading.value = false;
    }
};

// カテゴリーIDが変更された時
watch(() => props.categoryId, () => {
    fetchContents();
}, { immediate: true });
</script>

<style scoped>
.content-list {
    margin: 1.5rem 3rem;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.section-title {
    font-size: 1.7rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0;
}

.filter-controls {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
    align-items: center;
}

.search-container {
    position: relative;
    flex: 1;
    min-width: 200px;
}

.search-icon {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
}

.search-input {
    width: 80%;
    padding: 0.5rem 0.5rem 0.5rem 2.5rem;
    background-color: white;
    border-radius: 4px;
    font-size: 0.9rem;
}

.sort-container {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sort-select {
    padding: 0.5rem;
    border: 1px solid var(--border-light);
    border-radius: 4px;
    font-size: 0.9rem;
    background-color: white;
}

.filter-container {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

.filter-container input[type="checkbox"] {
    margin-right: 0.3rem;
}


.content-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 1rem;
}

.add-content-btn {
    background-color: var(--bg-navy);
    color: white;
    border: none;
    padding: 0.5rem 0.7rem;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.add-content-btn:hover {
    background-color: var(--hover-bg);
}

.loading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 15rem;
    text-align: center;
}

.loading-spinner {
    width: 30px;
    height: 30px;
    border: 3px solid var(--border-light);
    border-top: 3px solid var(--bg-navy);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 1rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.error {
    text-align: center;
    padding: 2rem;
    background-color: #f3f3f3;
    border-radius: 8px;
    border: 2px solid #b4b4b4;
    color: #e53e3e;
}

.retry-btn {
    background-color: var(--bg-navy);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 1rem;
}

.retry-btn:hover {
    background-color: var(--hover-bg);
}

.no-results {
    text-align: center;
    padding: 2rem;
    background-color: #f8f8f8;
    border-radius: 8px;
    color: #666;
    margin-top: 1rem;
}
</style>