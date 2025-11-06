<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HomePageAdminController extends Controller
{
    /** 🏠 Dashboard admin: daftar buku */
    public function index()
    {
        $books = Buku::orderByDesc('id_buku')->get();
        return view('homepage_admin', compact('books'));
    }

    /** ➕ Simpan buku baru */
    public function store(Request $request)
    {
        // VALIDASI: cover_image hanya divalidasi kalau ada filenya
        $validated = $request->validate([
            // 'id_buku' => 'required|integer', // aktifkan kalau PK manual
            'id_kategori' => 'required|integer',
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'isbn'        => 'required|string|max:50',
            'deskripsi'   => 'required|string',
            'cover_image' => 'sometimes|file|mimes:jpeg,png,jpg|max:2048', // <-- perbaikan
            'harga'       => 'required|numeric|min:0',
        ]);

        // UPLOAD cover (opsional)
        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('buku', 'public');
        }

        // SIMPAN data
        Buku::create([
            // 'id_buku'    => $request->id_buku, // pakai kalau PK manual
            'id_kategori' => $validated['id_kategori'],
            'title'       => $validated['title'],
            'author'      => $validated['author'],
            'isbn'        => $validated['isbn'],
            'deskripsi'   => $validated['deskripsi'],
            'cover_image' => $imagePath,
            'harga'       => $validated['harga'],
        ]);

        // REDIRECT ke homepage user
        return redirect()
            ->route('homepage')   // pastikan route('homepage') ada
            ->with('success', '📚 Buku berhasil ditambahkan!');
    }

    /** ❌ Hapus buku + cover (jika ada) */
    public function destroy(Buku $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();

        return redirect()
            ->route('homepage_admin')
            ->with('success', '🗑 Buku berhasil dihapus!');
    }

    /** 👤 Profil admin yang login */
    public function profil()
    {
        $admin = Auth::user();
        return view('profil_admin', compact('admin'));
    }
}
