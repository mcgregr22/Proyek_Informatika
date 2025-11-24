<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * 1️⃣ Menampilkan halaman konfirmasi pembayaran (data belum disimpan)
     */
    public function showPaymentForm(Request $request, $bookId)
    {
        $book = Buku::findOrFail($bookId);

        // Validasi data yang dikirim dari popup
        $validated = $request->validate([
            'qty' => 'required|integer|min:1',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'phone' => 'required|string',
        ]);

        return view('payment', [
            'book' => $book,
            'qty' => $validated['qty'],
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
            'phone' => $validated['phone'],
        ]);
    }

    /**
     * 2️⃣ Proses "Bayar Sekarang" → Simpan & panggil Midtrans
     */
    public function payNow(Request $request, $bookId)
    {
        $book = Buku::findOrFail($bookId);

        // Validasi lagi untuk keamanan
        $request->validate([
            'qty' => 'required|integer|min:1',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'phone' => 'required|string',
        ]);

        // 1️⃣ Simpan ke database
        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id_buku,   // gunakan id_buku sesuai struktur tabel Anda
            'qty' => $request->qty,
            'total' => $request->qty * $book->harga,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // 2️⃣ Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // 3️⃣ Data transaksi yang dikirim ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $purchase->id,         // ID transaksi
                'gross_amount' => $purchase->total,  // Total harga
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => $request->phone,
            ],
        ];

        // 4️⃣ Ambil Snap Token dari Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // 5️⃣ Kirim ke halaman Midtrans
        return view('midtrans.pay', [
            'snapToken' => $snapToken,
            'purchase' => $purchase
        ]);
    }
}
