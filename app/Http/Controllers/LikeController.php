<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Article $article)
    {
        $userId = Auth::id();
        
        // Cari apakah user ini sudah menyukai artikel ini sebelumnya
        $existingLike = Like::where('user_id', $userId)
                            ->where('article_id', $article->id)
                            ->first();

        if ($existingLike) {
            // Jika sudah ada, hapus datanya (Unlike)
            $existingLike->delete();
        } else {
            // Jika belum ada, buat data baru (Like)
            Like::create([
                'user_id' => $userId,
                'article_id' => $article->id
            ]);
        }

        return back(); // Kembali ke halaman artikel dengan status terbaru
    }

    // app/Http/Controllers/LikeController.php
    public function likedArticles()
    {
        $user = auth()->user();

        $articles = $user->likedArticles()
                        ->with('user') 
                        ->latest('likes.created_at') 
                        ->paginate(12);

        return view('articles.liked-articles', [
            'articles' => $articles,
        ]);
    }
}
