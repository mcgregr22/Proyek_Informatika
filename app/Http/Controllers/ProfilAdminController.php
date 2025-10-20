<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilAdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('profil_admin', compact('admin'));
    }
}
