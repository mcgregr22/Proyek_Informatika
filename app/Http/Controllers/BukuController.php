<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Koleksi;
use App\Models\Purchase; // 🟢 Tambahkan ini
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
            'id_kategori' => $request->id_kategori,
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

        return redirect()->route('pengelolaan')->with('success', '📚 Buku berhasil ditambahkan!');
    }

    /** 🛒 Proses Pembelian Buku */
    public function purchase(Request $request, $bookId)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $book = Buku::findOrFail($bookId);
        $total = $book->harga * $request->qty;

        Purchase::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id_buku,
            'qty' => $request->qty,
            'total' => $total,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', '🛍️ Pembelian berhasil! Silakan tunggu konfirmasi.');
    }
}
