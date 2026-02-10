<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PageController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/@' . Auth::user()->username);
    }
    return view('welcome');
})->name('home');

Route::get('/feed', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/read/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/@{username}', [ArticleController::class, 'author'])->name('author.profile');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/help', [PageController::class, 'help'])->name('help');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/donate', [PageController::class, 'donate'])->name('donate');

/*
|--------------------------------------------------------------------------
| Author & Profile Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(callback: function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/articles', [DashboardController::class, 'articles'])->name('dashboard.articles');


    // Profile Management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Articles Management
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::post('/store', [ArticleController::class, 'store'])->name('store');
        
        // Menggunakan slug untuk manajemen internal
        Route::get('/{slug}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::patch('/{slug}', [ArticleController::class, 'update'])->name('update');
        Route::delete('/{slug}', [ArticleController::class, 'destroy'])->name('destroy');
        
        Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');
    });

    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/articles/{article:slug}/like', [LikeController::class, 'toggle'])->name('articles.like');
    Route::get('/liked-articles', [LikeController::class, 'likedArticles'])->name('articles.liked');
    Route::get('/category/{category}', [ArticleController::class, 'category'])->name('articles.category');

    Route::get('/settings/profile', action: [AuthorController::class, 'profile'])->name('profile.setting');
    Route::patch('/settings/profile', action: [AuthorController::class, 'update'])->name('profile.setting.update');

    Route::post('/mark-notifications-read', function () {
            auth()->user()->unreadNotifications->markAsRead();
            return back();
        })->name('notifications.markAllRead');
    });


/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Rute admin lainnya nanti di sini...
    });

require __DIR__.'/auth.php';