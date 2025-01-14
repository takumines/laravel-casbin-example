<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property Comment[] $comments
 */
class Article extends Model
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
