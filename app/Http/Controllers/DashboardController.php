<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil artikel milik user (terbaru di atas)
        // Kita gunakan relasi articles() yang sudah kita buat di model User
        $articles = Auth::user()->articles()
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Mengirim data $articles ke view dashboard.blade.php
        return view('dashboard.dashboard', compact('articles'));
    }
    public function articles()
    {

        $articles = Auth::user()->articles()
                        ->orderBy('created_at', 'desc')
                        ->paginate(12);
    
        return view('dashboard.all-articles', compact('articles'));
    }

}