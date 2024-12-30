<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 管理権限ユーザー1人
        User::factory()->admin()->create([
            'name' => '管理 太郎'
        ]);

        // 編集権限ユーザー5人
        User::factory()->editor()->sequence(fn($sequence) => [
            'name' => "編集 太郎{$sequence->index}",
        ])->count(5)->create();

        // 閲覧権限ユーザー5人
        User::factory()->sequence(fn($sequence) => [
            'name' => "閲覧 太郎{$sequence->index}",
        ])->count(5)->create();
    }
}
