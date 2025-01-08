<?php

use App\Http\Controllers\Article\DestroyController;
use App\Http\Controllers\Article\IndexController;
use App\Http\Controllers\Article\ShowController;
use App\Http\Controllers\Article\StoreController as ArticleStoreController;
use App\Http\Controllers\Article\UpdateController;
use App\Http\Controllers\Comment\StoreController;
use Illuminate\Support\Facades\Route;

// 記事一覧
Route::get('/articles', [IndexController::class])->name('articles.index');
// 記事詳細
Route::get('/articles/{article}', [ShowController::class])->name('articles.show');

Route::middleware(['auth:sanctum'])->group(function () {
    // 記事作成
    Route::post('/articles', [ArticleStoreController::class])->name('articles.store');
    // 記事更新
    Route::put('/articles/{article}', [UpdateController::class])->name('articles.update');
    // 記事削除
    Route::delete('/articles/{article}', [DestroyController::class])->name('articles.delete');
    // コメント作成
    Route::post('/articles/{article}/comments', [StoreController::class])->name('comments.store');
    // コメント削除
    Route::delete('/articles/{article}/comments/{comment}', [DestroyController::class])
        ->name('comments.delete');
    // ユーザー一覧
    Route::get('/users', [IndexController::class])->name('users.index');
    // ユーザー詳細
    Route::get('/users/{user}', [ShowController::class])->name('users.show');
    // ユーザー削除
    Route::delete('/users/{user}', [DestroyController::class])->name('users.delete');
});

require __DIR__.'/auth.php';
