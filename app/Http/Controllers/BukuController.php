<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Koleksi;
use Illuminate\Support\Facades\Auth;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /** ➕ Simpan buku baru */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'deskripsi' => 'required',
            'kondisi' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'nullable|numeric',
            'listing_type' => 'required|array|min:1',
            'listing_type.*' => 'in:sell,exchange',
            'tanggal_rilis' => 'required|date_format:Y-m-d',
            'penerbit' => 'nullable|string',
            'bahasa' => 'nullable|string',
        ]);

        // Jika listing_type hanya exchange, harga tidak wajib
        if (in_array('sell', $request->listing_type)) {
            $request->validate([
                'harga' => 'required|numeric',
            ]);
        }

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('buku', 'public');
        }

        $buku = Buku::create([
            'kategori' => $request->kategori,
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,
            'kondisi' => $request->kondisi,
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

        return redirect()->route('pengelolaan.tambahbuku')->with('success', '📚 Buku berhasil ditambahkan!');
    }



    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        return view('tambahbuku', compact('kategori'));
    }

    /** ➕ Tampilkan form edit buku */
    public function edit($id)
    {
        $book = Buku::where('id_buku', $id)->where('user_id', Auth::id())->firstOrFail();
        $kategori = Kategori::orderBy('nama_kategori')->get();
        return view('editbuku', compact('book', 'kategori'));
    }

    /** ➕ Update buku */
    public function update(Request $request, $id)
    {
        $book = Buku::where('id_buku', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'kategori' => 'required',
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'deskripsi' => 'required',
            'kondisi' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'nullable|numeric',
            'listing_type' => 'required|array|min:1',
            'listing_type.*' => 'in:sell,exchange',
            'tanggal_rilis' => 'required|date_format:Y-m-d',
            'penerbit' => 'nullable|string',
            'bahasa' => 'nullable|string',
        ]);

        // Jika listing_type hanya exchange, harga tidak wajib
        if (in_array('sell', $request->listing_type)) {
            $request->validate([
                'harga' => 'required|numeric',
            ]);
        }

        $imagePath = $book->cover_image; // Default to existing image
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $imagePath = $request->file('cover_image')->store('buku', 'public');
        }

        $book->update([
            'kategori' => $request->kategori,
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,
            'kondisi' => $request->kondisi,
            'cover_image' => $imagePath,
            'harga' => $request->harga,
            'tanggal_rilis' => $request->tanggal_rilis,
            'penerbit' => $request->penerbit,
            'bahasa' => $request->bahasa,
            'listing_type' => implode(',', $request->listing_type),
        ]);

        return redirect()->route('mycollection.index')->with('success', '📚 Buku berhasil diperbarui!');
    }

    /** ➕ Hapus buku */
    public function destroy($id)
    {
        $book = Buku::where('id_buku', $id)->where('user_id', Auth::id())->firstOrFail();

        // Delete image if exists
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        // Delete from koleksi first (if exists)
        Koleksi::where('id_buku', $id)->where('user_id', Auth::id())->delete();

        $book->delete();

        return redirect()->route('mycollection.index')->with('success', '📚 Buku berhasil dihapus!');
    }
}
