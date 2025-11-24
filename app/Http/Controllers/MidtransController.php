<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    /* ======================================================
     * 1. CREATE TRANSACTION (CHECKOUT)
     * ====================================================== */
    public function createCheckout(Request $request)
    {
        $user = Auth::user();
        $cart = Keranjang::with('buku')->where('user_id', $user->id)->get();

        if ($cart->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        // Hitung total pembayaran
        $total = 0;
        foreach ($cart as $c) {
            $total += $c->harga * $c->qty;
        }

        // Buat order
        $order = Order::create([
            'user_id'  => $user->id,
            'order_id' => 'ORD-' . time(),
            'total'    => $total,
            'status'   => 'pending'
        ]);

        // Simpan item order
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'buku_id'  => $item->id_buku,
                'qty'      => $item->qty,
                'harga'    => $item->harga,
            ]);
        }

        // Data ke midtrans
        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ]
        ];

        // Dapatkan Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment', [
            'snapToken' => $snapToken,
            'order'     => $order
        ]);
    }

    public function buyNow(Request $request, $bookId)
{
    $user = Auth::user();

    // qty dari tombol Beli Sekarang
    $qty = $request->qty;

    // Ambil buku
    $book = \App\Models\Buku::findOrFail($bookId);

    // Hitung total: harga × qty
    $total = $book->harga * $qty;

    // Buat order baru
    $order = Order::create([
        'user_id'  => $user->id,
        'order_id' => 'ORD-' . time(),
        'total'    => $total,
        'status'   => 'pending'
    ]);

    // Simpan item order
    OrderItem::create([
        'order_id' => $order->id,
        'buku_id'  => $book->id_buku,
        'qty'      => $qty,
        'harga'    => $book->harga,
    ]);

    // Data ke Midtrans
    $params = [
        'transaction_details' => [
            'order_id'     => $order->order_id,
            'gross_amount' => $order->total,
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email'      => $user->email,
        ]
    ];

    // Ambil Snap Token
    $snapToken = \Midtrans\Snap::getSnapToken($params);

    return view('payment', [
        'snapToken' => $snapToken,
        'order'     => $order
    ]);
}


    /* ======================================================
     * 2. MIDTRANS CALLBACK / WEBHOOK
     * ====================================================== */
    public function notificationHandler(Request $request)
    {
        Log::info('Midtrans Callback Received:', $request->all());

        $notif = new \Midtrans\Notification();

        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status;

        // Ambil order berdasarkan order_id Midtrans
        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            Log::error("ORDER NOT FOUND: " . $orderId);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status berdasarkan respon Midtrans
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            $order->status = 'paid';

            // Hapus keranjang user
            Keranjang::where('user_id', $order->user_id)->delete();

        } elseif ($transactionStatus == 'pending') {
            $order->status = 'pending';

        } elseif ($transactionStatus == 'expire') {
            $order->status = 'expired';

        } elseif ($transactionStatus == 'cancel') {
            $order->status = 'canceled';

        } else {
            $order->status = 'failed';
        }

        $order->save();

        Log::info("ORDER UPDATED --> " . $order->status);

        return response()->json(['message' => 'Callback processed']);
    }
}

