<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyCollectionController extends Controller
{
    /**
     * Tampilkan daftar koleksi buku milik user (halaman pilih saat tukar).
     */
    public function index(Request $request)
    {
        $userId      = Auth::id();
        $requestedId = $request->query('requested'); // ID buku target yang ingin ditukar

        // Ambil koleksi milik user dengan join ke tabel _buku
        $myBooks = DB::table('koleksi as k')
            ->join('_buku as b', 'k.id_buku', '=', 'b.id_buku')
            ->where('k.user_id', $userId)
            ->select(
                // kolom buku
                'b.id_buku', 'b.title', 'b.author', 'b.isbn',
                'b.deskripsi', 'b.cover_image', 'b.harga', 'b.user_id as owner_user_id',
                // kolom koleksi
                'k.id_koleksi as koleksi_id', 'k.qty', 'k.access_status',
                'k.koleksi_date', 'k.purchased_at', 'k.created_at as koleksi_created_at'
            )
            ->orderBy('b.title', 'asc')
            ->get();

        return view('mycollection', compact('myBooks', 'requestedId'));
    }
}
