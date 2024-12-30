<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 管理権限ユーザーの記事10記事作成
        $admin = User::query()->where('role', UserRole::Admin->value)->first();
        Article::factory()->count(10)->create([
            'user_id' => $admin->id
        ]);

        // 編集権限ユーザー一人につき記事10記事作成
        $editors = User::query()->where('role', UserRole::Editor->value)->get();
        $editors->each(function (User $editor) {
            Article::factory()->count(10)->create([
                'user_id' => $editor->id
            ]);
        });
    }
}
