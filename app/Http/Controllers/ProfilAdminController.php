<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilAdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user(); // ambil data admin login
        return view('profil_admin', compact('admin'));
    }

    // 🧩 Tambahan: fungsi untuk update profil admin
    public function update(Request $request)
    {
        $admin = Auth::user();

        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        // Update data admin
        $admin->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
