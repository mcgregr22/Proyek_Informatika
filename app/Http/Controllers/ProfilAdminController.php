<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilAdminController extends Controller
{
    public function index()
    {
        $admin = auth()->user(); // Ambil user yang sedang login

        return view('profil_admin', compact('admin'));
    }
}
