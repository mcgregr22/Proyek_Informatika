<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HomePageAdminController extends Controller
{
    /** 🏠 Dashboard admin: daftar buku */
    public function index()
    {
        $books = Buku::orderByDesc('id_buku')->get();
        return view('homepage_admin', compact('books'));
    }

    /** ➕ Simpan buku baru */
 public function store(Request $request)
{
    $request->validate([
        'id_buku' => 'nullable',
        'id_kategori' => 'required',
        'title' => 'required',
        'author' => 'required',
        'isbn' => 'required',
        'deskripsi' => 'required',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'harga' => 'required|numeric',
        'listing_type' => 'required|array|min:1',
        'listing_type.*' => 'in:sell,exchange',
    ]);

    $imagePath = null;
    if ($request->hasFile('cover_image')) {
        $imagePath = $request->file('cover_image')->store('buku', 'public');
    }

    Buku::create([
       // 'id_buku' => $request->id_buku,
        'id_kategori' => $request->id_kategori,
        'title' => $request->title,
        'author' => $request->author,
        'isbn' => $request->isbn,
        'deskripsi' => $request->deskripsi,
        'cover_image' => $imagePath,
        'harga' => $request->harga,
        // 🔹 simpan sebagai string dipisahkan koma
        'listing_type' => implode(',', $request->listing_type),
        'user_id' => Auth::id()
        
    ]);

    return redirect()->route('pengelolaan')->with('success', '📚 Buku berhasil ditambahkan!');
}

    /** ❌ Hapus buku + cover (jika ada) */
    public function destroy(Buku $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();

        return redirect()
            ->route('homepage_admin')
            ->with('success', '🗑 Buku berhasil dihapus!');
    }

    /** 👤 Profil admin yang login */
    public function profil()
    {
        $admin = Auth::user();
        return view('profil_admin', compact('admin'));
    }
   public function updateProfil(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'password' => 'nullable|min:6',
    ]);

    $admin = auth()->user();

    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->phone = $request->phone;

    if ($request->password) {
        $admin->password = bcrypt($request->password);
    }

    $admin->save();

    return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
}

}