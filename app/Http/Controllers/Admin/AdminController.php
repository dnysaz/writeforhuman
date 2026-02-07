<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_articles' => Article::count(),
            'verified_users' => User::whereNotNull('email_verified_at')->count(),
            // Ambil 10 user terbaru
            'recent_users' => User::latest()->take(10)->get(),
            // Ambil 10 artikel terbaru dengan relasi user (pemiliknya)
            'recent_articles' => Article::with('user')->latest()->take(10)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}