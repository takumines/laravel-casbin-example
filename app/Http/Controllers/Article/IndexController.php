<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleListCollection;
use App\Models\Article;

class IndexController extends Controller
{
    /**
     * @return ArticleListCollection
     */
    public function __invoke(): ArticleListCollection
    {
        $articles = Article::query()->with(['user', 'comments'])->paginate(10);

        return new ArticleListCollection($articles);
    }
}
