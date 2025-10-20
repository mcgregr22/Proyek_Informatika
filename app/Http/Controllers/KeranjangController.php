<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Keranjang;
use App\Models\Buku;

class KeranjangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // TAMPILKAN KERANJANG
    public function index()
    {
        $items = Keranjang::where('user_id', Auth::id())
                          ->with('buku')
                          ->get();

        $subtotal = $items->sum(fn($i) => $i->harga * $i->qty);
        $tax = (int) round($subtotal * 0.10);
        $total = $subtotal + $tax;

        // JIKA VIEW KAMU bernama keranjang.blade.php (bukan folder)
        return view('keranjang', compact('items', 'subtotal', 'tax', 'total'));

        
    }

    // TAMBAH ITEM KE KERANJANG
    public function add(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required',
            'qty'     => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($data['book_id']);

        $item = Keranjang::firstOrNew([
            'user_id' => Auth::id(),
            'id_buku' => $buku->id_buku,
        ]);

        if ($item->exists) {
            $item->qty += $data['qty'];
        } else {
            $item->qty = $data['qty'];
            $item->harga = $buku->harga;
        }

        $item->save();

        return redirect()->route('cart.index')->with('success', 'Buku ditambahkan ke keranjang.');
    }

    // UPDATE QTY
    public function update(Request $request, $id)
    {
        $data = $request->validate(['qty' => 'required|integer|min:1']);
        $item = Keranjang::where('user_id', Auth::id())->findOrFail($id);
        $item->qty = $data['qty'];
        $item->save();

        return back()->with('success', 'Jumlah diperbarui.');
    }

    // HAPUS SATU ITEM
    public function remove($id)
    {
        $item = Keranjang::where('user_id', Auth::id())->findOrFail($id);
        $item->delete();

        return back()->with('success', 'Item dihapus.');
    }

    // KOSONGKAN KERANJANG
    public function clear()
    {
        Keranjang::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Keranjang dikosongkan.');
    }
}
