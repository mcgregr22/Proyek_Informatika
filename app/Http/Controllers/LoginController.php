<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function show()
    {
        return view('login');
    }

    // Proses autentikasi
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user(); // Ambil data user yang login

            // Cek role dan redirect ke halaman sesuai role
            if ($user->role === 'admin') {
                return redirect()->intended('/homepage_admin')->with('success', 'Selamat datang, Admin!');
            } else {
                return redirect()->intended('/homepage')->with('success', 'Login berhasil!');
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau kata sandi salah!',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda sudah logout.');
    }
}
