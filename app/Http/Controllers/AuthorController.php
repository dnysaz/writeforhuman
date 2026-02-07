<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    /**
     * Update profile author (User)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi data
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'bio'        => ['nullable', 'string', 'max:500'],
            'url'        => ['nullable', 'url', 'max:255'],
            'url_name'   => ['nullable', 'string', 'max:50'],
            'show_stats' => ['nullable', 'boolean'],
            'show_bio'   => ['nullable', 'boolean'],
        ]);

        // Proses Update
        // Kita menggunakan array_merge untuk memastikan toggle yang tidak dicentang 
        // tetap masuk sebagai 'false' ke dalam database.
        $user->update([
            'name'       => $validated['name'],
            'bio'        => $validated['bio'],
            'url'        => $validated['url'],
            'url_name'   => $validated['url_name'],
            'show_stats' => $request->has('show_stats'),
            'show_bio'   => $request->has('show_bio'),
        ]);

        // Jika request via AJAX/Fetch
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
                'user' => $user
            ]);
        }

        // Jika request via Form biasa
        return back()->with('success', 'Your profile has been updated.');
    }

    /**
     * Menampilkan halaman setting profil
     */
    public function profile()
    {
        // Mengambil data user yang sedang login
        $user = auth()->user();
    
        // Mengirim data user ke view
        return view('dashboard.profile-author', compact('user'));
    }
}