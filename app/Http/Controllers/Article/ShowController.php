<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ShowController extends Controller
{
    /**
     * @param int $articleId
     * @return ArticleResource
     */
    public function __invoke(int $articleId): ArticleResource
    {
        $article = Article::query()->with(['user', 'comments'])->findOrFail($articleId);

        return new ArticleResource($article);
    }
}
