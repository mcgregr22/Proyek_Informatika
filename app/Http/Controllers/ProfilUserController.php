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

    // 🧩 Tambahan: fungsi untuk update profil user
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        // Update data user
        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
