<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    // Mass assignment protection
    protected $fillable = ['user_id', 'article_id'];

    /**
     * Relasi ke User (Siapa yang memberikan Like)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Article (Artikel mana yang disukai)
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}