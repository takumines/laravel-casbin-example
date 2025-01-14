<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\PutRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Auth\Access\AuthorizationException;

class UpdateController extends Controller
{
    /**
     * @param PutRequest $request
     * @param int $articleId
     * @return ArticleResource
     * @throws AuthorizationException
     */
    public function __invoke(PutRequest $request, int $articleId): ArticleResource
    {
        $params = $request->validated();

        $article = Article::query()->findOrFail($articleId);

        if ($request->user()->id !== $article->user_id) {
            throw new AuthorizationException('You are not authorized to update this article');
        }

        $article->title = $params['title'];
        $article->content = $params['content'];
        $article->save();

        $article->load(['user', 'comments']);

        return new ArticleResource($article);
    }
}
