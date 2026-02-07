<?php

// app/Models/Article.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = [
        'user_id', 'title', 'slug', 'content', 
        'category','cover_image', 'word_count', 'reading_time', 'status'
    ];

    // Otomatis buat slug saat title diisi
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->slug = Str::slug($article->title) . '-' . Str::random(5);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Untuk cek apakah user sedang login sudah like artikel ini
    public function isLiked()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}