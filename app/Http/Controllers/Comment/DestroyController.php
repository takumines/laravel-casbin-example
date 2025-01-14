<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DestroyController extends Controller
{
    /**
     * @param int $articleId
     * @param int $commentId
     * @return Response
     */
    public function __invoke(int $articleId, int $commentId): Response
    {
        $comment = Comment::query()
            ->where('article_id', $articleId)
            ->where('id', $commentId)
            ->first();

        if (!$comment) {
            throw new NotFoundHttpException('Comment not found');
        }

        $comment->delete();

        return response()->noContent();
    }
}
