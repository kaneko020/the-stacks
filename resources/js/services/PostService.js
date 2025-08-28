import apiClient from './api';

export default {
  // サンプルAPIデータを取得
  getSampleData() {
    return apiClient.get('/sample');
  },
  
  // 投稿一覧を取得
  getPosts() {
    return apiClient.get('/posts');
  },
  
  // 特定の投稿を取得（ID指定）
  getPost(id) {
    return apiClient.get(`/posts/${id}`);
  }
};
