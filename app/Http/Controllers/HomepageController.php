<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        // Filter pencarian global (judul/penulis/ISBN)
        $search = function ($query) use ($q) {
            if ($q) {
                $query->where(function ($x) use ($q) {
                    $x->where('title', 'like', "%{$q}%")
                      ->orWhere('author', 'like', "%{$q}%")
                      ->orWhere('isbn', 'like', "%{$q}%");
                });
            }
        };

        // ID kategori (sesuaikan dengan data kamu)
        $ID_KAT_HUMOR   = 1;
        $ID_KAT_HISTORY = 2;

        // 3 bagian buku
        $booksHumor = Buku::where('id_kategori', $ID_KAT_HUMOR)
            ->tap($search)->orderBy('title')->limit(4)->get();

        $booksHistory = Buku::where('id_kategori', $ID_KAT_HISTORY)
            ->tap($search)->orderBy('title')->limit(6)->get();

        $booksRecs = Buku::tap($search)
            ->inRandomOrder()->limit(5)->get();

        // Kirim ke Blade
        return view('homepage', compact('booksHumor', 'booksHistory', 'booksRecs', 'q'));
    }

    // ⬇️ Taruh di luar index()
    public function show($id)
    {
         $book = Buku::where('id_buku', $id)->firstOrFail();
    
    return view('detailbuku', compact('book'));
}

}