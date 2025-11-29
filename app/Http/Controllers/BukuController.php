<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Koleksi;
use Illuminate\Support\Facades\Auth;
use App\Models\Kategori;

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
}
