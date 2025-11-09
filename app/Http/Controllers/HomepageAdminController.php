<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HomePageAdminController extends Controller
{
    public function index()
    {
        $books = Buku::orderByDesc('id_buku')->get();
        return view('homepage_admin', compact('books'));
    }

    public function profil()
    {
        $admin = Auth::user();
        return view('profil_admin', compact('admin'));
    }
}
