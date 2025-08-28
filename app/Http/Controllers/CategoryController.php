<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * カテゴリー一覧を取得
     */
    public function getList()
    {
        $categories = Category::active()
            ->ordered()
            ->withCount('contents')
            ->get();

        return response()->json($categories);
    }

    /**
     * IDを基にカテゴリーを取得
     */
    public function getById($id)
    {
        $category = Category::with('contents')->findOrFail($id);

        return response()->json($category);
    }
}
