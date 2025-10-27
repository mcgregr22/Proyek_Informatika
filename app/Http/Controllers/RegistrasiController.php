<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    // ✅ Tampilkan halaman register
    public function show()
    {
        return view('register');
    }

    // ✅ Proses penyimpanan data registrasi
    public function store(Request $request)
    {
        // 1️⃣ Validasi input
        $data = $request->validate([
            'nama_lengkap'       => ['required', 'string', 'max:255'],
            'nomor_telepon'      => ['nullable', 'string', 'max:30'],
            'email'              => ['required', 'email', 'max:255', 'unique:users,email'],
            'role'               => ['required', 'in:pengguna,admin'],
            'kata_sandi'         => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'email.unique'       => 'Email sudah terdaftar. Gunakan email lain.',
            'kata_sandi.min'     => 'Kata sandi minimal 6 karakter.',
            'kata_sandi.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        // 2️⃣ Simpan user (password di-hash!)
        User::create([
            'name'     => $data['nama_lengkap'],
            'phone'    => $data['nomor_telepon'] ?? null,
            'email'    => $data['email'],
            'role'     => $data['role'],
            'password' => Hash::make($data['kata_sandi']),
        ]);

        // 3️⃣ Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login.show')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
