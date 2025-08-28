import { createRouter, createWebHistory } from 'vue-router';

// コンポーネントのインポート
import HomeComponent from '../components/HomeComponent.vue';
import ContentComponent from '../components/ContentComponent.vue';

// ルートの定義
const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeComponent
    },
    {
        path: '/category/:id',
        name: 'category',
        component: ContentComponent,
        props: route => ({ categoryId: Number(route.params.id) }),
    }
];

// ルーターインスタンスの作成
const router = createRouter({
    history: createWebHistory('/'),
    routes
});

export default router;
