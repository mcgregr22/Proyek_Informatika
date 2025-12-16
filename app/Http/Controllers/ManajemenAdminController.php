<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenAdminController extends Controller
{
    // ✅ 1. tampilkan semua user
    public function index()
    {
        $users = User::orderBy('id')->get();
        return view('manajemen_admin.index', compact('users'));
    }

    // ✅ 2. edit akun
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $currentUser = auth::user();

        // Admin tidak bisa edit akun admin lain
        if ($currentUser->role === 'admin' && $user->role === 'admin') {
            return redirect()->route('manajemen_admin')->with('error', 'Anda tidak dapat mengedit akun admin lain.');
        }

        return view('manajemen_admin.edit', compact('user'));
    }

    // ✅ 3. update akun
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->route('manajemen_admin')->with('success', 'Akun berhasil diperbarui!');
    }

    // ✅ 4. delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $currentUser = auth::user();

        // Admin tidak bisa hapus akun admin lain
        if ($currentUser->role === 'admin' && $user->role === 'admin') {
            return redirect()->route('manajemen_admin')->with('error', 'Anda tidak dapat menghapus akun admin lain.');
        }

        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus!');
    }

    // ✅ 5. edit role
    public function editRole($id)
    {
        $user = User::findOrFail($id);
        return view('manajemen_admin.role', compact('user'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string'
        ]);

        $user = User::findOrFail($id);
        $newRole = strtolower($request->input('role')); // normalisasi ke huruf kecil semua
        $currentUser = auth::user();

        // 🟢 Pastikan user login terbaca
        if (!$currentUser) {
            return redirect()->route('login.show')->with('error', 'Sesi login Anda telah berakhir. Silakan login kembali.');
        }

        // 🚫 Admin tidak bisa edit role admin lain
        if ($currentUser->role === 'admin' && $user->role === 'admin') {
            return redirect()->route('manajemen_admin')->with('error', 'Anda tidak dapat mengedit role admin lain.');
        }

        // ⚠ Jika role sama, beri peringatan
        if ($user->role === $newRole) {
            return redirect()->back()->with('warning', 'Role pengguna sudah ' . $newRole . '.');
        }

        // 🚫 Jika admin mengubah dirinya sendiri jadi pengguna
        if ($currentUser->id === $user->id && in_array($newRole, ['user', 'pengguna'])) {
            $user->role = $newRole;
            $user->save();

            auth::logout(); // Logout otomatis
            return redirect()->route('login.show')
                ->with('warning', 'Anda telah mengubah peran Anda menjadi pengguna dan otomatis keluar.');
        }

        // ✅ Selain itu, ubah biasa
        $user->role = $newRole;
        $user->save();

        return redirect()->route('manajemen_admin')->with('success', 'Role berhasil diperbarui!');
    }
}
