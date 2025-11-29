<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class HomepageController extends Controller
{
    // -------------------------------
    // 🏠 TAMPILAN HOMEPAGE
    // -------------------------------
    public function index(Request $request)
    {
        $q = $request->get('q');

        // Filter pencarian global
        $search = function ($query) use ($q) {
            if ($q) {
                $query->where(function ($x) use ($q) {
                    $x->where('title', 'like', "%{$q}%")
                      ->orWhere('author', 'like', "%{$q}%")
                      ->orWhere('isbn', 'like', "%{$q}%");
                });
            }
        
        };
        

        // ID kategori (ubah sesuai data kamu)
        $ID_KAT_HUMOR   = 1;
        $ID_KAT_HISTORY = 2;

        // Buku kategori Humor
        $booksHumor = Buku::where('id_kategori', $ID_KAT_HUMOR)
            ->tap($search)->orderBy('title')->limit(4)->get();

        // Buku kategori History
        $booksHistory = Buku::where('id_kategori', $ID_KAT_HISTORY)
            ->tap($search)->orderBy('title')->limit(6)->get();

        // Buku rekomendasi random
        $booksRecs = Buku::tap($search)
            ->inRandomOrder()->limit(1000)->get();

        return view('homepage', compact('booksHumor', 'booksHistory', 'booksRecs', 'q'));
    }

    // -------------------------------
    // 📘 DETAIL BUKU
    // -------------------------------
  public function show($id)
{
    $book = Buku::with('user')->findOrFail($id);
    return view('detailbuku', compact('book'));
}


}