<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap'        => ['required','string','max:255'],
            'nomor_telepon'       => ['required','string','max:30'],
            'email'               => ['required','email','max:255','unique:users,email'],
            'role'                => ['required','in:pengguna,admin'],
            'kata_sandi'          => ['required','string','min:6','confirmed'], // butuh field kata_sandi_confirmation
        ]);

        $user = User::create([
            'name'     => $data['nama_lengkap'],
            'phone'    => $data['nomor_telepon'] ?? null, // sesuaikan kolom kalau ada
            'email'    => $data['email'],
            'role'     => $data['role'],
            'password' => Hash::make($data['kata_sandi']),
        ]);

        // ✅ Perbaikan di sini: gunakan route('login')
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
