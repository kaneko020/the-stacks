<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->comment('カテゴリーID');
            $table->string('title')->comment('タイトル');
            $table->string('author')->nullable()->comment('作者名');
            $table->text('description')->nullable()->comment('説明');
            $table->string('image_url')->comment('画像のURL');
            $table->integer('rating')->default(0)->comment('評価');
            $table->boolean('is_favorite')->default(false)->comment('お気に入りフラグ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
