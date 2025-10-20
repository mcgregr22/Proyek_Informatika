<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SwapbookController extends Controller
{
    public function index()
    {
        // Ambil data buku dari tabel 'books'
        $books = DB::table('books')->get();

        // Kirim data ke view
        return view('swapbook', compact('books'));
    }
}
