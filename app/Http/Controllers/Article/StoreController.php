<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\PostRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class StoreController extends Controller
{
    /**
     * @param PostRequest $request
     * @return ArticleResource
     */
    public function __invoke(PostRequest $request): ArticleResource
    {
        $prams = $request->validated();

        $article = new Article();
        $article->user_id = $request->user()->id;
        $article->title = $prams['title'];
        $article->content = $prams['content'];
        $article->save();

        $article->load('user');

        return new ArticleResource($article);
    }
}
