<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        // Cari berdasarkan judul, penulis, ISBN (filter semua)
        $search = function ($query) use ($q) {
            if ($q) {
                $query->where(function ($x) use ($q) {
                    $x->where('title', 'like', "%{$q}%")
                      ->orWhere('author', 'like', "%{$q}%")
                      ->orWhere('isbn', 'like', "%{$q}%");
                });
            }
        };

        // Kategori (sesuaikan angka)
        $ID_KAT_HUMOR   = 1;
        $ID_KAT_HISTORY = 2;

        // 3 bagian buku
        $booksHumor = Buku::where('id_kategori', $ID_KAT_HUMOR)
            ->tap($search)
            ->orderBy('title')
            ->limit(4)
            ->get();

        $booksHistory = Buku::where('id_kategori', $ID_KAT_HISTORY)
            ->tap($search)
            ->orderBy('title')
            ->limit(6)
            ->get();

        $booksRecs = Buku::tap($search)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        // Kirim semua ke Blade
        return view('homepage', compact('booksHumor', 'booksHistory', 'booksRecs', 'q'));
    }
}
