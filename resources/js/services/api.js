import axios from 'axios';

// Axiosインスタンスを作成
const apiClient = axios.create({
  baseURL: '/api',
  headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
  },
  withCredentials: true
});

// リクエストインターセプター
apiClient.interceptors.request.use(
  config => {
    // リクエスト前の処理（例: トークンの追加など）
    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

// レスポンスインターセプター
apiClient.interceptors.response.use(
  response => {
    // レスポンス処理
    return response;
  },
  error => {
    // エラーハンドリング（例: 認証エラー処理など）
    if (error.response && error.response.status === 401) {
      // 未認証の場合の処理
      console.error('認証エラー');
    }
    return Promise.reject(error);
  }
);

export default apiClient;
