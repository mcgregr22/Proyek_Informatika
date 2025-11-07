<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Str;

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
            ->inRandomOrder()->limit(5)->get();

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


    // -------------------------------
    // ➕ TAMBAH BUKU (fungsi store)
    // -------------------------------
   public function store(Request $request)
{
    $validated = $request->validate([
        'id_buku' => 'nullable|string',
        'id_kategori' => 'required|integer',
        'title' => 'required|string',
        'author' => 'required|string',
        'isbn' => 'required|string',
        'deskripsi' => 'required|string',
        'harga' => 'nullable|numeric',
        'listing_type' => 'required|array|min:1',
        'listing_type.*' => 'in:sell,exchange',
        'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('cover_image')) {
        $filename = time().'_'.$request->file('cover_image')->getClientOriginalName();
        $request->file('cover_image')->move(public_path('covers'), $filename);
        $validated['cover_image'] = $filename;
    }

    $validated['listing_type'] = implode(',', $validated['listing_type']);

    // ✅ Wajib! Simpan user yang menambahkan buku
    $validated['user_id'] = auth()->id();

    Buku::create($validated);

    return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
}

}
