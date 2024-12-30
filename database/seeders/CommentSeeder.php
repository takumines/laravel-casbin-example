<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 管理権限ユーザーのコメントを対象の記事をランダムに10件作成
        $admin = User::query()->where('role', UserRole::Admin->value)->first();
        $articles = Article::query()->inRandomOrder()->take(10)->get();
        $articles->each(function (Article $article) use ($admin) {
            Comment::factory()->create([
                'user_id' => $admin->id,
                'article_id' => $article->id
            ]);
        });

        // 編集権限ユーザーのコメントを対象の記事をランダムに10件作成
        $editors = User::query()->where('role', UserRole::Editor->value)->get();
        $editors->each(function (User $editor) {
            $articles = Article::query()->inRandomOrder()->take(10)->get();
            $articles->each(function (Article $article) use ($editor) {
                Comment::factory()->create([
                    'user_id' => $editor->id,
                    'article_id' => $article->id
                ]);
            });
        });
    }
}
