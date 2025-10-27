<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;



class HomePageAdminController extends Controller
{
    // 🏠 Menampilkan halaman dashboard admin
    public function index()
    {
        $books = Buku::all(); // ✅ ambil semua data dari tabel _buku
        return view('homepage_admin', compact('books'));
    }

    // ➕ Menyimpan data buku baru
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required',
            'id_kategori' => 'required',
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'deskripsi' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('buku', 'public');
        }

        Buku::create([
            'id_buku' => $request->id_buku,
            'id_kategori' => $request->id_kategori,
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,
            'cover_image' => $imagePath,
            'harga' => $request->harga,
        ]);

        return redirect()->route('homepage_admin')->with('success', '📚 Buku berhasil ditambahkan!');
    }

    // ❌ Menghapus buku berdasarkan ID
    public function destroy($id)
    {
        $book = Buku::findOrFail($id);

        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('homepage_admin')->with('success', '🗑️ Buku berhasil dihapus!');
    }
    // 👤 Menampilkan profil admin yang sedang login
public function profil()
{
    $admin = auth()->user();
    return view('profil_admin', compact('admin'));
}

}
