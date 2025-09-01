<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// カテゴリーAPI
Route::get('/categories', [CategoryController::class, 'getList']);
Route::get('/category/{id}', [CategoryController::class, 'getById']);

// サンプルAPI
Route::get('/sample', function () {
    return response()->json([
        'message' => 'Laravel + Vue + SQLite API 動作確認',
        'status' => 'success',
        'data' => [
            'timestamp' => now(),
            'info' => 'このAPIはサンプルです'
        ]
    ]);
});
