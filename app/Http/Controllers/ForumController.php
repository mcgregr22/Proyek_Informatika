<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumPost;
use App\Models\ForumComment;
use Illuminate\Support\Facades\Auth; // Perlu ditambahkan untuk auth()->id()

class ForumController extends Controller
{
    // Menampilkan halaman forum
    public function index()
    {
        // Eager load user untuk post, dan user untuk komentar. Gunakan withCount('comments') untuk efisiensi.
        $posts = ForumPost::with(['user'])->withCount('comments')->latest('created_at')->get();
        return view('forumdiscuss', compact('posts'));
    }

    /**
     * Menyimpan posting baru.
     */
    public function store(Request $request)
    {
        // PERBAIKAN 1: Tambahkan validasi untuk 'title'
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', // Title wajib diisi
            'content' => 'required|string|max:5000',
        ]);

        ForumPost::create([
            'user_id' => Auth::id(), // Gunakan Auth::id() yang lebih aman
            'title' => $validatedData['title'], // PERBAIKAN 2: Simpan Title
            'content' => $validatedData['content'],
        ]);

        return redirect()->back()->with('success', 'Postingan berhasil dibuat!'); // Redirect back lebih user friendly
    }

    /**
     * Menyimpan komentar baru.
     */
    public function storeComment(Request $request, $id_post)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return back()->with('error', 'Anda harus login untuk berkomentar.');
        }

        $validatedData = $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        ForumComment::create([
            'id_post' => $id_post, // PERBAIKAN 3: Menggunakan 'id_post' (foreign key yang benar)
            'user_id' => Auth::id(), // Gunakan Auth::id()
            'komentar' => $validatedData['komentar'],
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!'); // Redirect back lebih baik
    }
}