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

    /** Tampilkan isi keranjang */
    public function index()
    {
        $rows = Keranjang::with('buku')
            ->where('user_id', Auth::id())
            ->get();

        $items = [];
        $subtotal = 0;

        foreach ($rows as $row) {
            if (!$row->buku) continue;

            $price = (int) $row->harga;
            $qty   = (int) $row->qty;

            $items[] = [
                'id_buku'  => (int) $row->id_buku,
                'title'    => $row->buku->title,
                'author'   => $row->buku->author,
                'isbn'     => $row->buku->isbn,
                'cover'    => $row->buku->cover_image,
                'price'    => $price,
                'qty'      => $qty,
                'subtotal' => $price * $qty,
            ];

            $subtotal += $price * $qty;
        }

        $tax      = (int) round($subtotal * 0.10);
        $shipping = 0;
        $total    = $subtotal + $tax + $shipping;

        return view('keranjang', compact('items', 'subtotal', 'tax', 'shipping', 'total'));
    }

    /** Tambah ke keranjang */
  public function add(Request $request)
{
    $id_buku = $request->book_id;
    $qty = $request->qty ?? 1;

    $buku = Buku::findOrFail($id_buku);

    $item = Keranjang::where('id_buku', $id_buku)
        ->where('user_id', Auth::id())
        ->first();

    if ($item) {
        $item->qty += $qty;
        $item->save();
    } else {
        Keranjang::create([
            'user_id' => Auth::id(),
            'id_buku' => $id_buku,
            'qty'     => $qty,
            'harga'   => $buku->harga,
        ]);
    }

    // 🔥 WAJIB: SELALU RETURN JSON, TANPA SYARAT AJAX
    return response()->json([
        'success' => true,
        'message' => 'Berhasil ditambahkan'
    ]);
}


    /** Hapus dari keranjang */
    public function remove($id_buku)
    {
        Keranjang::where('user_id', Auth::id())
            ->where('id_buku', (int) $id_buku)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Buku dihapus dari keranjang.');
    }
    /** Tambah kuantitas */public function increase($id_buku)
{
    $item = Keranjang::where('user_id', Auth::id())
        ->where('id_buku', $id_buku)
        ->first();

    if ($item) {
        $item->qty += 1;
        $item->save();
    }

    return back()->with('success', 'Jumlah buku berhasil ditambahkan!');
}

    /** Kurangi kuantitas */
public function decrease($id_buku)
{
    $item = Keranjang::where('user_id', Auth::id())
        ->where('id_buku', $id_buku)
        ->first();

    if ($item) {
        if ($item->qty > 1) {
            $item->qty -= 1;
            $item->save();
        } else {
            // Jika qty = 1, hapus item
            $item->delete();
        }
    }

    return back()->with('success', 'Jumlah buku berhasil dikurangi!');
}

}
