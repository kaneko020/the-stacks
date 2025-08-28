<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('vue');
});

// SPA用のフォールバックルート - すべてのGETリクエストをVueに転送
Route::get('/{any}', function () {
    return view('vue');
})->where('any', '.*');