<?php

use App\Http\Controllers\Article\DestroyController as ArticleDestroyController;
use App\Http\Controllers\Article\IndexController as ArticleIndexController;
use App\Http\Controllers\Article\ShowController as ArticleShowController;
use App\Http\Controllers\Article\StoreController as ArticleStoreController;
use App\Http\Controllers\Article\UpdateController;
use App\Http\Controllers\Comment\DestroyController as CommentDestroyController;
use App\Http\Controllers\Comment\StoreController as CommentStoreController;
use App\Http\Controllers\User\DestroyController as UserDestroyController;
use App\Http\Controllers\User\IndexController as UserIndexController;
use App\Http\Controllers\User\ShowController as UserShowController;
use Illuminate\Support\Facades\Route;

// 記事一覧
Route::get('/articles', ArticleIndexController::class)
    ->name('articles.index');
// 記事詳細
Route::get('/articles/{article_id}', ArticleShowController::class)
    ->name('articles.show');

Route::middleware(['auth:sanctum'])->group(function () {
    // 記事作成
    Route::post('/articles', ArticleStoreController::class)
        ->name('articles.store');
    // 記事更新
    Route::put('/articles/{article_id}', UpdateController::class)
        ->name('articles.update');
    // 記事削除
    Route::delete('/articles/{article_id}', ArticleDestroyController::class)
        ->name('articles.delete');
    // コメント作成
    Route::post('/articles/{article_id}/comments', CommentStoreController::class)
        ->name('comments.store');
    // コメント削除
    Route::delete('/articles/{article_id}/comments/{comment_id}', CommentDestroyController::class)
        ->name('comments.delete');
    // ユーザー一覧
    Route::get('/users', UserIndexController::class)
        ->name('users.index');
    // ユーザー詳細
    Route::get('/users/{user_id}', UserShowController::class)
        ->name('users.show');
    // ユーザー削除
    Route::delete('/users/{user_id}', UserDestroyController::class)
        ->name('users.delete');
});

require __DIR__.'/auth.php';
