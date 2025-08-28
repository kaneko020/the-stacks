import './bootstrap';
import '../css/variables.css';
import { createApp } from 'vue';
import router from './router';
import axios from 'axios';

// ルートコンポーネント
import App from './components/App.vue';

// Font Awesome の設定
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

// 使用したいアイコンをインポート
import { faStar, faHeart, faPlus, faSearch } from '@fortawesome/free-solid-svg-icons';
import { faStar as faStarRegular } from '@fortawesome/free-regular-svg-icons';
import { faTwitter, faGithub } from '@fortawesome/free-brands-svg-icons';

// ライブラリに追加
library.add(faStar, faHeart, faPlus, faSearch, faStarRegular, faTwitter, faGithub);

// グローバルにaxiosを設定
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Vueアプリケーションを作成
const app = createApp(App);

// FontAwesome コンポーネントを登録
app.component('fa', FontAwesomeIcon);

// Routerを追加
app.use(router);

// アプリケーションをマウント
app.mount('#app');
