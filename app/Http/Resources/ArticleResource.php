<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Article $article */
        $article = $this->resource;

        return [
            'article_id' => $article->id,
            'user_id' => $article->user_id,
            'user_name' => $article->user->name,
            'title' => $article->title,
            'content' => $article->content,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at,
            'comments' => new CommentListCollection($article->comments),
        ];
    }
}
