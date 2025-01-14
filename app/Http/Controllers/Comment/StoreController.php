<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\PostRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Comment;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StoreController extends Controller
{
    /**
     * @param PostRequest $request
     * @param int $articleId
     * @return ArticleResource
     */
    public function __invoke(PostRequest $request, int $articleId): ArticleResource
    {
        $prams = $request->validated();

        $article = Article::query()->where('id', $articleId)->first();
        if (!$article) {
            throw new NotFoundHttpException('Article not found');
        }

        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->article_id = $article->id;
        $comment->content = $prams['content'];
        $comment->save();

        $article->load(['user', 'comments']);

        return new ArticleResource($article);
    }
}
