<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 1️⃣ Menampilkan halaman pembayaran sebelum data disimpan
    public function showPaymentForm(Request $request, $bookId)
    {
        $book = Buku::findOrFail($bookId);

        // data sementara yang dikirim dari popup
        $validated = $request->validate([
            'qty' => 'required|integer|min:1',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        return view('payment', [
            'book' => $book,
            'qty' => $validated['qty'],
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
        ]);
    }

    // 2️⃣ Menyimpan ke database setelah user menekan "Bayar Sekarang"
    public function payNow(Request $request, $bookId)
    {
        $book = Buku::findOrFail($bookId);

        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id_buku,
            'qty' => $request->qty,
            'total' => $request->qty * $book->harga,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'status' => 'paid', // langsung paid setelah user klik bayar
        ]);

        return redirect()->route('homepage')->with('success', 'Pembayaran berhasil! Terima kasih telah membeli 📚');
    }
}
