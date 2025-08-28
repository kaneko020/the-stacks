<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => '映画',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'ドラマ',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'アニメ',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => '漫画',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => '小説',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        $contents = [
            // 映画
            [
                'category_id' => 1,
                'title' => 'シャッターアイランド',
                'author' => 'マーティン・スコセッシ',
                'description' => 'ある精神科病院からこつ然と姿を消したひとりの患者。その捜査のために現地を訪れた連邦保安官は、数々の不可解な謎に翻弄され、次第に現実感を失っていく。',
                'image_url' => 'shutter-island.jpg',
                'rating' => 5,
                'is_favorite' => true,
            ],
            [
                'category_id' => 1,
                'title' => '秒速5センチメートル',
                'author' => '新海誠',
                'description' => null,
                'image_url' => 'byousoku.jpg',
                'rating' => 5,
                'is_favorite' => true,
            ],
            [
                'category_id' => 1,
                'title' => '君の名は。',
                'author' => '新海誠',
                'description' => '山に囲まれた田舎町で、退屈な毎日を過ごしていた少女。ところがある日を境に、東京で憧れの都会生活を送る見知らぬ男の子になる夢を繰り返し見るようになり...。',
                'image_url' => 'kiminonaha.jpg',
                'rating' => 4,
                'is_favorite' => false,
            ],
            [
                'category_id' => 1,
                'title' => '言の葉の庭',
                'author' => '新海誠',
                'description' => null,
                'image_url' => 'kotonohanoniwa.jpg',
                'rating' => 3,
                'is_favorite' => false,
            ],
            // 小説
            [
                'category_id' => 5,
                'title' => '方舟',
                'author' => '夕木春御央',
                'description' => null,
                'image_url' => 'hakobune.jpg',
                'rating' => 5,
                'is_favorite' => true,
            ],
            [
                'category_id' => 5,
                'title' => 'シャドウ',
                'author' => '道尾秀介',
                'description' => null,
                'image_url' => 'shadow.jpg',
                'rating' => 5,
                'is_favorite' => true,
            ],
            [
                'category_id' => 5,
                'title' => '一次元の挿し木',
                'author' => '松下龍之介',
                'description' => null,
                'image_url' => 'ichijigen.jpg',
                'rating' => 4,
                'is_favorite' => true,
            ],
            [
                'category_id' => 5,
                'title' => '十角館の殺人',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'juukakukan.jpg',
                'rating' => 5,
                'is_favorite' => true,
            ],
            [
                'category_id' => 5,
                'title' => '水車館の殺人',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'suishakan.jpg',
                'rating' => 4,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '迷路館の殺人',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'meirokan.jpg',
                'rating' => 4,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '人形館の殺人',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'ningyoukan.jpg',
                'rating' => 3,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '時計館の殺人 上',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'tokeikan-jo.jpg',
                'rating' => 4,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '時計館の殺人 下',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'tokeikan-ge.jpg',
                'rating' => 4,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '黒猫館の殺人',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'kuronekokan.jpg',
                'rating' => 3,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '暗黒館の殺人 一',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'ankokukan-1.jpg',
                'rating' => 4,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '暗黒館の殺人 二',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'ankokukan-2.jpg',
                'rating' => 4,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '暗黒館の殺人 三',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'ankokukan-3.jpg',
                'rating' => 4,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '暗黒館の殺人 四',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'ankokukan-4.jpg',
                'rating' => 4,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => 'びっくり館の殺人',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'bikkurikan.jpg',
                'rating' => 3,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '奇面館の殺人 上',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'kimenkan-jo.jpg',
                'rating' => 3,
                'is_favorite' => false,
            ],
            [
                'category_id' => 5,
                'title' => '奇面館の殺人 下',
                'author' => '綾辻行人',
                'description' => null,
                'image_url' => 'kimenkan-ge.jpg',
                'rating' => 3,
                'is_favorite' => false,
            ],
        ];

        foreach ($contents as $contentData) {
            Content::create($contentData);
        }
    }
}
