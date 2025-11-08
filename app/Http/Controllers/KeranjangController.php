<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class KeranjangController extends Controller
{
    public function index()
    {
        // Struktur cart di session: [id_buku => ['qty' => n]] atau [id_buku => n]
        $cart = session('cart', []);

        $qtyById = [];
        foreach ($cart as $id => $val) {
            $qtyById[(int) $id] = is_array($val) ? (int) ($val['qty'] ?? 1) : (int) $val;
        }

        if (empty($qtyById)) {
            return view('keranjang', [
                'items'    => [],
                'subtotal' => 0,
                'tax'      => 0,
                'shipping' => 0,
                'total'    => 0,
            ]);
        }

        // Ambil detail buku berdasarkan id_buku
        $books = Buku::whereIn('id_buku', array_keys($qtyById))
            ->get()
            ->keyBy('id_buku');

        $items = [];
        $subtotal = 0;

        foreach ($qtyById as $id => $qty) {
            $book = $books->get($id);
            if (!$book) continue;

            $price = (int) $book->harga;

            $items[] = [
                'id_buku'  => $book->id_buku,
                'title'    => $book->title,
                'author'   => $book->author,
                'isbn'     => $book->isbn,
                'cover'    => $book->cover_image, // contoh: "covers/abc.jpg"
                'price'    => $price,
                'qty'      => $qty,
                'subtotal' => $price * $qty,
            ];

            $subtotal += $price * $qty;
        }

        $tax = (int) round($subtotal * 0.10);
        $shipping = 0;
        $total = $subtotal + $tax + $shipping;

        return view('keranjang', compact('items', 'subtotal', 'tax', 'shipping', 'total'));
    }

    // Tambah item ke keranjang
    public function add(Request $request)
    {
        $id  = (int) $request->input('book_id');
        $qty = max(1, (int) $request->input('qty', 1));

        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $cart[$id] = is_array($cart[$id])
                ? ['qty' => ($cart[$id]['qty'] ?? 0) + $qty]
                : $cart[$id] + $qty;
        } else {
            $cart[$id] = ['qty' => $qty];
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Buku ditambahkan ke keranjang.');
    }

    // Hapus satu item dari keranjang
    public function remove($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
}