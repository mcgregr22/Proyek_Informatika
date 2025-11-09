<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Koleksi;

class MyCollectionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua koleksi milik user yang sedang login, termasuk data buku
        $myBooks = Koleksi::with('buku')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return $item->buku; // ambil objek buku dari relasi
            })
            ->filter(); // buang null jika ada

        return view('mycollection', compact('myBooks'));
    }
}
