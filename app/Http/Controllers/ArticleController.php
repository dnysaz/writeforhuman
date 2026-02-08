<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Like;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Menyimpan artikel baru (Handcrafted)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:life,wellness,mindset,connection,growth,creativity,society,work,technology,general',
            'cover_image' => 'nullable|string', // Menampung pilihan "vibe-x"
            'status' => 'required|in:draft,published'
        ]);
    
        try {
            // Logika menghitung statistik tulisan
            $words = str_word_count(strip_tags($request->content));
            $readingTime = ceil($words / 200);
    
            // Membuat slug unik secara otomatis dari judul
            $slug = Str::slug($validated['title']);
            
            // Cek jika slug sudah ada, tambahkan angka unik di belakangnya
            $count = Article::where('slug', 'LIKE', "{$slug}%")->count();
            $finalSlug = $count ? "{$slug}-" . ($count + 1) : $slug;
    
            $article = $request->user()->articles()->create([
                'title' => $validated['title'],
                'slug' => $finalSlug,
                'content' => $validated['content'],
                'category' => $validated['category'],
                'cover_image' => $validated['cover_image'],
                'status' => $validated['status'],
                'word_count' => $words,
                'reading_time' => $readingTime,
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Your handcrafted thought is preserved.',
                'data' => $article
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The sanctuary failed to save: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan halaman edit berdasarkan slug
     */
    public function edit($slug)
    {
        // Pastikan hanya pemilik yang bisa akses
        $article = Article::where('user_id', Auth::id())
                          ->where('slug', $slug)
                          ->firstOrFail();

        // Ambil list artikel untuk sidebar dashboard
        $articles = Auth::user()->articles()->latest()->get();

        return view('dashboard.edit-article', compact('article', 'articles'));
    }

    /**
     * Memperbarui artikel melalui slug
     */
    public function update(Request $request, $slug)
    {
        $article = Article::where('user_id', Auth::id())
                          ->where('slug', $slug)
                          ->firstOrFail();
    
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:life,wellness,mindset,connection,growth,creativity,society,work,technology,general',
            'cover_image' => 'nullable|string', // Agar bisa ganti vibe visual
            'status' => 'required|in:draft,published'
        ]);
    
        try {
            // Hitung ulang statistik berdasarkan konten baru
            $words = str_word_count(strip_tags($request->content));
            $readingTime = ceil($words / 200);
    
            $article->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'category' => $validated['category'],
                'cover_image' => $validated['cover_image'],
                'status' => $validated['status'],
                'word_count' => $words,
                'reading_time' => $readingTime,
                // 'slug' => Str::slug($validated['title']),
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Your handcrafted thought has been re-preserved.',
                'data' => $article
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The sanctuary failed to update: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus artikel dari sanctuary
     */
    public function destroy($slug)
    {
        $article = Article::where('user_id', Auth::id())
                          ->where('slug', $slug)
                          ->firstOrFail();
    
        $article->delete();
    
        // Cek apakah permintaan datang dari JavaScript (AJAX/Fetch)
        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Article has been erased.'
            ], 200);
        }
    
        // Default jika diklik dari form biasa
        return redirect()->route('dashboard')->with('success', 'Article has been erased.');
    }

    /*
    |--------------------------------------------------------------------------
    | Public Views
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $articles = Article::where('status', 'published')
                        ->with('user')
                        ->latest()
                        ->paginate(15);

        return view('articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
                        ->where('status', 'published')
                        ->firstOrFail();

        return view('articles.read', compact('article'));
    }

    public function author($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $articles = $user->articles()
                        ->where('status', 'published')
                        ->latest()
                        ->paginate(12);

        $totalAppreciations = Like::whereIn('article_id', $user->articles()->pluck('id'))->count();
        return view('articles.author', compact('user', 'articles', 'totalAppreciations'));
    }

    public function category($category)
    {
        // Mengambil artikel yang sudah dipublikasikan berdasarkan kategori
        $articles = Article::where('status', 'published')
                            ->where('category', $category)
                            ->with('user') // Eager load user untuk avatar/nama
                            ->latest()
                            ->paginate(12);

        // Kirim judul halaman berdasarkan kategori (huruf kapital di awal)
        $title = ucfirst($category);

        return view('articles.category', compact('articles', 'title', 'category'));
    }
}