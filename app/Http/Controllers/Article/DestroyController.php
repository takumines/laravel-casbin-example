<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyController extends Controller
{
    /**
     * @param Request $request
     * @param int $articleId
     * @return Response
     * @throws AuthorizationException
     */
    public function __invoke(Request $request, int $articleId): Response
    {
        $article = Article::query()->findOrFail($articleId);

        if ($request->user()->id !== $article->user_id) {
            throw new AuthorizationException('You are not authorized to delete this article');
        }

        $article->delete();

        return response()->noContent();
    }
}
