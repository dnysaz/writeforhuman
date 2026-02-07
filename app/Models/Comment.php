<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['user_id', 'article_id', 'body'];

    // Relasi ke User (Penulis Komentar)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Article (Komentar ini milik artikel mana)
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}