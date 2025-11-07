<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // 🔹 MENAMPILKAN DAFTAR TRANSAKSI
    public function index()
    {
        // Data dummy sementara, nanti bisa diganti dengan query database
        $transactions = [
            (object)['id' => 'TXN001', 'user_name' => 'Andi Pratama', 'date' => '2023-10-26', 'total' => 150000, 'status' => 'Completed', 'avatar' => 'https://placehold.co/40x40/57b561/ffffff?text=AP'],
            (object)['id' => 'TXN002', 'user_name' => 'Budi Santoso', 'date' => '2023-10-25', 'total' => 225000, 'status' => 'Pending', 'avatar' => 'https://placehold.co/40x40/737373/ffffff?text=BS'],
            (object)['id' => 'TXN003', 'user_name' => 'Citra Dewi', 'date' => '2023-10-24', 'total' => 300000, 'status' => 'Completed', 'avatar' => 'https://placehold.co/40x40/f4b360/ffffff?text=CD'],
        ];

        // Mengirim ke view resources/views/purchase.blade.php
        return view('purchase', compact('transactions'));
    }

    // 🔹 MENAMPILKAN DETAIL TRANSAKSI
    public function show($id)
    {
        $transaction = (object)[
            'id' => 'TXN001',
            'user_name' => 'Andi Pratama',
            'date' => '2023-10-26',
            'status' => 'Completed',
            'avatar' => 'https://placehold.co/40x40/57b561/ffffff?text=AP',
            'total' => 150000,
        ];

        $books = [
            (object)['title' => 'Pemrograman Laravel', 'author' => 'Budi Santoso', 'price' => 50000, 'quantity' => 2],
            (object)['title' => 'Belajar PHP Modern', 'author' => 'Citra Dewi', 'price' => 50000, 'quantity' => 1],
        ];

        $subtotal = 150000;
        $shipping = 15000;

        return view('purchase-detail', compact('transaction', 'books', 'subtotal', 'shipping'));
    }
}
