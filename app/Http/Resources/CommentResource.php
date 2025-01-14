<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Comment $comment */
        $comment = $this->resource;
        return [
            'comment_id' => $comment->id,
            'user_name' => $comment->user->name,
            'user_id' => $comment->user_id,
            'content' => $comment->content,
        ];
    }
}
