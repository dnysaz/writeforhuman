<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'bio',
        'url',
        'url_name',
        'provider_name',
        'provider_id',
        'avatar',
        'show_stats',
        'show_bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!$user->username) {
                $user->username = Str::slug($user->name);
                
                $originalUsername = $user->username;
                $count = 1;
                while (static::where('username', $user->username)->exists()) {
                    $user->username = $originalUsername . '-' . $count++;
                }
            }
        });
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likedArticles()
    {
        // Mengambil artikel melalui tabel likes
        return $this->belongsToMany(Article::class, 'likes');
    }
}