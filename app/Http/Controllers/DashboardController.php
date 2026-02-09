<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $articles = $user->articles()
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Mengambil notifikasi yang belum dibaca
        $notifications = $user->unreadNotifications;

        return view('dashboard.dashboard', compact('articles', 'notifications'));
    }
    public function articles()
    {

        $articles = Auth::user()->articles()
                        ->orderBy('created_at', 'desc')
                        ->paginate(12);
    
        return view('dashboard.all-articles', compact('articles'));
    }

}