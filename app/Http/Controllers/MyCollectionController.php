<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;

class MyCollectionController extends Controller
{
    /**
     * Tampilkan daftar koleksi buku milik user (halaman pilih saat tukar).
     */
    public function index(Request $request)
    {
        $userId      = Auth::id();
        $requestedId = $request->query('requested'); // ID buku target yang ingin ditukar

        // Ambil koleksi buku berdasarkan pemilik saat ini (user_id di _buku)
        // Jadi setelah tukar buku, cukup ubah user_id di _buku, koleksi otomatis ikut berubah
        $myBooks = Buku::where('user_id', $userId)
            ->orderBy('title', 'asc')
            ->get();

        return view('mycollection', compact('myBooks', 'requestedId'));
    }
}
