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
        // tabel keranjang punya user_id → wajib login
        $this->middleware('auth');
    }

    /** Tampilkan keranjang (ambil dari TABEL keranjang) */
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

        return view('keranjang', compact('items','subtotal','tax','shipping','total'));
    }

    /** Tambah/naikkan qty item ke TABEL keranjang (upsert by user_id,id_buku) */
    public function add(Request $request)
    {
        // NOTE: tabel buku kamu bernama "_buku" (lihat model Buku::$table)
        $data = $request->validate([
            'id_buku' => 'required|integer|min:1|exists:_buku,id_buku',
            'qty'     => 'nullable|integer|min:1',
        ]);

        $userId = Auth::id();                    // aman & eksplisit
        $idBuku = (int) $data['id_buku'];
        $qtyReq = max(1, (int) ($data['qty'] ?? 1));

        // ambil harga terbaru dari tabel buku
        $buku  = Buku::where('id_buku', $idBuku)->firstOrFail();
        $harga = (int) $buku->harga;

        // upsert (hindari duplicate key unique [user_id,id_buku])
        $row = Keranjang::where('user_id', $userId)
            ->where('id_buku', $idBuku)
            ->first();

        if ($row) {
            $row->qty   = (int) $row->qty + $qtyReq;
            $row->harga = $harga;   // optional: sync harga terbaru
            $row->save();
        } else {
            Keranjang::create([
                'user_id' => $userId,
                'id_buku' => $idBuku,
                'qty'     => $qtyReq,
                'harga'   => $harga,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Buku ditambahkan ke keranjang.');
    }

    /** Hapus satu item (berdasarkan id_buku) dari TABEL keranjang */
    public function remove($idBuku)
    {
        Keranjang::where('user_id', Auth::id())
            ->where('id_buku', (int) $idBuku)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
}
