<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        Purchase::create([
            'user_id' => Auth::id(),
            'book_id' => $bookId,
            'qty' => $request->qty,
            'total' => $request->qty * 20000, // contoh, bisa ambil dari harga buku
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);
        

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat! 🎉');
    }
}
