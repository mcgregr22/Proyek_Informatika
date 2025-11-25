<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Keranjang;

class MidtransController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey     = config('midtrans.server_key');
        \Midtrans\Config::$isProduction  = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized   = true;
        \Midtrans\Config::$is3ds         = true;
    }

    /* ==========================================================
     * 1. CREATE TRANSACTION (CHECKOUT)
     * ==========================================================*/
    public function createCheckout(Request $request)
    {
        $user = Auth::user();
        $cart = Keranjang::with('buku')->where('user_id', $user->id)->get();

        if ($cart->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $total = $cart->sum(fn ($c) => $c->harga * $c->qty);

        $order = Order::create([
            'user_id'  => $user->id,
            'order_id' => 'ORD-' . time(),
            'total'    => $total,
            'status'   => 'pending'
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'buku_id'  => $item->id_buku,
                'qty'      => $item->qty,
                'harga'    => $item->harga,
            ]);
        }

        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment', [
            'snapToken' => $snapToken,
            'order'     => $order,
        ]);
    }

    /* ==========================================================
     * 2. BUY NOW
     * ==========================================================*/
    public function buyNow(Request $request, $bookId)
    {
        $user = Auth::user();
        $qty  = $request->qty;

        $book = \App\Models\Buku::findOrFail($bookId);

        $order = Order::create([
            'user_id'  => $user->id,
            'order_id' => 'ORD-' . time(),
            'total'    => $book->harga * $qty,
            'status'   => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'buku_id'  => $book->id_buku,
            'qty'      => $qty,
            'harga'    => $book->harga,
        ]);

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

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment', [
            'snapToken' => $snapToken,
            'order'     => $order,
        ]);
    }


    /* ==========================================================
     * 3. MIDTRANS WEBHOOK / NOTIFICATION HANDLER
     * ==========================================================*/
   public function handleNotification(Request $request)
{
    Log::info("MIDTRANS CALLBACK PAYLOAD: " . json_encode($request->all()));

    $payload = $request->all();
    $orderId = $payload['order_id'] ?? null;

    if (!$orderId) {
        Log::error("No order_id in callback!");
        return response()->json(['error' => 'order_id missing'], 400);
    }

    // Jika test webhook dari dashboard
    if (str_starts_with($orderId, 'payment_notif_test')) {
        Log::info("Webhook TEST diterima, tidak update DB.");
        return response()->json(['message' => 'Test callback OK']);
    }

    // Ambil detail dari Midtrans secara resmi
    $notif = new \Midtrans\Notification();

    $transaction = $notif->transaction_status;
    $type        = $notif->payment_type;
    $fraud       = $notif->fraud_status;
    $va_numbers  = $notif->va_numbers ?? [];
    $bank        = $notif->bank ?? null;

    // Ambil order berdasarkan kolom order_id (bukan id)
    $order = Order::where('order_id', $orderId)->first();

    if (!$order) {
        Log::error("Order tidak ditemukan: " . $orderId);
        return response()->json(['message' => 'order not found'], 404);
    }

    // Update data VA (hanya untuk bank_transfer)
    if ($type === 'bank_transfer' && !empty($va_numbers)) {
        $order->bank      = $va_numbers[0]['bank'] ?? null;
        $order->va_number = $va_numbers[0]['va_number'] ?? null;
    }

    // Update kolom payment_type
    $order->payment_type = $type;
    $order->fraud_status = $fraud;
    $order->transaction_status = $transaction;

    // Mapping status Midtrans → status di tabel
    if ($transaction == 'settlement') {
        $order->status = 'paid';
        $order->settlement_time = now();
    }
    elseif ($transaction == 'cancel' || $transaction == 'deny' || $transaction == 'expire') {
        $order->status = 'failed';
    }
    elseif ($transaction == 'pending') {
        $order->status = 'pending';
    }

    $order->save();

    Log::info("ORDER UPDATED: " . json_encode($order));

    return response()->json(['message' => 'Notification processed']);
}


}
