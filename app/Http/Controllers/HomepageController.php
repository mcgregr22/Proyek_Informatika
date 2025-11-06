<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->query('q', ''));

        // sesuaikan dengan ID kategori kamu
        $ID_KAT_HUMOR   = 1;
        $ID_KAT_HISTORY = 2;

        $applySearch = function ($q) {
            return function ($builder) use ($q) {
                $builder->when($q !== '', function ($qq) use ($q) {
                    $qq->where(function ($x) use ($q) {
                        $x->where('title', 'like', "%{$q}%")
                          ->orWhere('author','like', "%{$q}%")
                          ->orWhere('isbn',  'like', "%{$q}%");
                    });
                });
            };
        };

        // Humor & Comedy
        $booksHumor = Buku::where('id_kategori', $ID_KAT_HUMOR)
            ->whereNotNull('cover_image')              // opsional: hanya yang punya cover
            ->when(true, $applySearch($q))
            ->orderBy('title')
            ->limit(6)
            ->get();

        // History
        $booksHistory = Buku::where('id_kategori', $ID_KAT_HISTORY)
            ->whereNotNull('cover_image')
            ->when(true, $applySearch($q))
            ->orderBy('title')
            ->limit(6)
            ->get();

        // Recommendations (tanpa tabel clicks):
        // ambil yang TERBARU & ada cover. Kalau kosong, fallback ke terbaru apa saja.
        $booksRecs = Buku::whereNotNull('cover_image')
            ->when(true, $applySearch($q))
            ->orderByDesc('id_buku')   // terbaru
            ->limit(6)
            ->get();

        if ($booksRecs->isEmpty()) {
            $booksRecs = Buku::when(true, $applySearch($q))
                ->orderByDesc('id_buku')
                ->limit(6)
                ->get();
        }

        return view('homepage', compact('booksHumor', 'booksHistory', 'booksRecs', 'q'));
    }

    public function show($id)
    {
        // tanpa tabel clicks, cukup tampilkan detail
        $book = Buku::findOrFail($id);
        return view('detailbuku', compact('book'));
    }
}
