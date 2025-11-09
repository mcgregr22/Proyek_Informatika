<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Koleksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /** ➕ Simpan buku baru */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'deskripsi' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
            'listing_type' => 'required|array|min:1',
            'listing_type.*' => 'in:sell,exchange',
            'tanggal_rilis' => 'required|date_format:Y-m-d',
            'penerbit' => 'nullable|string',
            'bahasa' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('buku', 'public');
        }

        $buku =Buku::create([
            'id_kategori' => $request->id_kategori,
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,
            'cover_image' => $imagePath,
            'harga' => $request->harga,
            'tanggal_rilis' => $request->tanggal_rilis,
            'penerbit' => $request->penerbit,
            'bahasa' => $request->bahasa,
            'listing_type' => implode(',', $request->listing_type),
            'user_id' => Auth::id(),
        ]);

        Koleksi::create([
        'user_id' => Auth::id(),
        'id_buku' => $buku->id_buku,
        'qty' => 1,
        'access_status' => 'private',
        'koleksi_date' => now(),
    ]);

        return redirect()->route('pengelolaan')->with('success', '📚 Buku berhasil ditambahkan!');
    }

    

    // /** ❌ Hapus buku + cover (jika ada) */
    // public function destroy(Buku $book)
    // {
    //     // Cegah user lain menghapus buku bukan miliknya
    //     if ($book->user_id !== Auth::id()) {
    //         abort(403, 'Anda tidak memiliki izin untuk menghapus buku ini.');
    //     }

    //     if ($book->cover_image) {
    //         Storage::disk('public')->delete($book->cover_image);
    //     }

    //     $book->delete();

    //     return redirect()
    //         ->route('pengelolaan')
    //         ->with('success', '🗑 Buku berhasil dihapus!');
    // }
}
