<template>
    <div class="home-container">
        <h1></h1>
        <p>カテゴリーを追加</p>

        <div class="card">
            <button @click="fetchSampleData" class="btn">サンプルAPIデータを取得</button>
            <div v-if="loading" class="loading">読み込み中...</div>
            <div v-if="data" class="data-container">
                <h3>取得データ:</h3>
                <pre>{{ JSON.stringify(data, null, 2) }}</pre>
            </div>
            <div v-if="error" class="error">{{ error }}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';

interface ApiResponse {
    data: any;
    status: number;
    statusText: string;
    headers: any;
    config: any;
}

const data = ref<any | null>(null);
const loading = ref(false);
const error = ref<string | null>(null);

async function fetchSampleData(): Promise<void> {
    loading.value = true;
    error.value = null;

    try {
        const response: ApiResponse = await axios.get('/api/sample');
        data.value = response.data;
    } catch (err: any) {
        error.value = '読み込みエラー: ' + err.message;
        console.error(err);
    } finally {
        loading.value = false;
    }
}
</script>

<style scoped>
.home-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
}

h1 {
    color: #242424;
    margin-bottom: 1rem;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 2rem;
}

.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    margin-right: 0.5rem;
    margin-bottom: 1rem;
    background-color: #727272;
    color: white;
}

.loading {
    margin-top: 1rem;
    color: #505050;
}

.data-container {
    margin-top: 1rem;
    background-color: #ebebeb;
    color: #242424;
    padding: 1rem;
    border-radius: 4px;
    overflow-x: auto;
}

pre {
    white-space: pre-wrap;
}

.error {
    margin-top: 1rem;
    color: #e3342f;
}
</style>
