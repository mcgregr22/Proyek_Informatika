<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    // Tampilkan halaman register
    public function show()
    {
        return view('register'); 
    }

    public function store(Request $request)
{
    // 1) Validasi input
    $data = $request->validate([
        'nama_lengkap'    => ['required', 'string', 'max:255'],
        'nomor_telepon'   => ['nullable', 'string', 'max:30'],
        'email'           => ['required', 'email', 'max:255', 'unique:users,email'],
        'role'            => ['nullable', 'string', 'max:50'],
        'kata_sandi'      => ['required', 'string', 'min:6'],
        // kalau kamu punya field konfirmasi: aktifkan baris di bawah
        // 'kata_sandi_konfirmasi' => ['same:kata_sandi'],
    ], [
        'email.unique'     => 'Email sudah terdaftar.',
        'kata_sandi.min'   => 'Kata sandi minimal 6 karakter.',
        // tambahkan pesan lain kalau perlu
    ]);

    // 2) Simpan user (password di-hash!)
    User::create([
        'name'     => $data['nama_lengkap'],
        'phone'    => $data['nomor_telepon'] ?? null,
        'email'    => $data['email'],
        'role'     => $data['role'] ?? 'user',
        'password' => Hash::make($data['kata_sandi']),
    ]);

    // 3) Arahkan ke halaman login + pesan sukses
    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
}
}