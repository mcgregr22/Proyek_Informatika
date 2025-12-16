<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KategoriController;
use App\Models\Kategori;

class HomepageController extends Controller
{
    // -------------------------------
    // 🏠 TAMPILAN HOMEPAGE
    // -------------------------------
    public function index(Request $request)
    {
        $q = $request->get('q');
        $kategoriDipilih = $request->get('kategori');

        // Debug: Uncomment baris ini untuk melihat nilai yang diterima
        // dd($q, $kategoriDipilih);

        // Ambil kategori untuk dropdown
        $kategoriList = Kategori::orderBy('nama_kategori')->get();

        // Query dasar
        $booksQuery = Buku::query();

        // 🔍 Search (judul / penulis / isbn)
        if (!empty($q)) {
            $booksQuery->where(function ($x) use ($q) {
                $x->where('title', 'like', "%{$q}%")
                  ->orWhere('author', 'like', "%{$q}%")
                  ->orWhere('isbn', 'like', "%{$q}%");
            });
        }

        // 🎯 Filter kategori berdasarkan nama kategori (bukan id)
        if (!empty($kategoriDipilih)) {
            $booksQuery->where('kategori', $kategoriDipilih);
        }

        // Ambil hasil pencarian (tanpa limit untuk pencarian/filter)
        $booksRecs = $booksQuery
                        ->orderBy('title')
                        ->get();

        // Kategori beserta bukunya (untuk bagian "per kategori") - limit 6
        $kategoriWithBooks = Kategori::orderBy('nama_kategori')
            ->get()
            ->map(function ($kat) {
                $kat->books = Buku::where('kategori', $kat->nama_kategori)
                    ->orderBy('title')
                    ->limit(6)
                    ->get();
                return $kat;
            });

        return view('homepage', compact(
            'booksRecs',
            'kategoriList',
            'kategoriDipilih',
            'kategoriWithBooks',
            'q'
        ));
    }

    // -------------------------------
    // 📘 DETAIL BUKU
    // -------------------------------
    public function show($id)
    {
        $book = Buku::with('user')->findOrFail($id);
        return view('detailbuku', compact('book'));
    }
        public function landing()
    {
        // Ambil 4 buku random dari database
        $featuredBooks = Buku::inRandomOrder()->limit(4)->get();
        // Return view dengan data buku random
        return view('home', compact('featuredBooks'));  // Ganti 'landing' dengan nama file Blade Anda
    }
}
