<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'author',
        'description',
        'image_url',
        'rating',
        'is_favorite',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'rating' => 'integer'
    ];

    /**
     * このコンテンツが属するカテゴリーを取得
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * お気に入りのコンテンツのみを取得するスコープ
     */
    public function scopeFavorites($query)
    {
        return $query->where('is_favorite', true);
    }

    /**
     * 評価でフィルタリングするスコープ
     */
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }
}
