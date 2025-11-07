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

        // Upload cover kalau ada
        if ($request->hasFile('cover_image')) {
            $filename = time().'_'.$request->file('cover_image')->getClientOriginalName();
            $request->file('cover_image')->move(public_path('covers'), $filename);
            $validated['cover_image'] = $filename;
        }

        // Gabungkan array listing_type menjadi string
        $validated['listing_type'] = implode(',', $validated['listing_type']);

        // Simpan ke database
        Buku::create($validated);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }
}



