<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilUserController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil data user login
        return view('profil_user', compact('user'));
    }
}
