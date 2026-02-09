<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Notifications\CommentNotification;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = $article->comments()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body'],
        ]);

        // Kirim notifikasi ke pemilik artikel (kecuali dia komentar di post sendiri)
        if ($article->user_id !== auth()->id()) {
            $article->user->notify(new CommentNotification($comment));
        }

        return back()->with('success', 'Your response has been handcrafted.');
    }
}