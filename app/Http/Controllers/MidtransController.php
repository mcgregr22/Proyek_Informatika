<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Keranjang;
use App\Models\Buku;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans SDK
        \Midtrans\Config::$serverKey     = config('midtrans.server_key');
        \Midtrans\Config::$isProduction  = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized   = true;
        \Midtrans\Config::$is3ds         = true;
    }

    /* ==========================================================
     * 1) CHECKOUT (KERANJANG)
     * ==========================================================*/
    public function createCheckout(Request $request)
    {
        $user = Auth::user();

        $cart = Keranjang::with('buku')
            ->where('user_id', $user->id)
            ->get();

        if ($cart->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $total = $cart->sum(fn($c) => $c->harga * $c->qty);

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

        return view('payment', compact('snapToken', 'order'));
    }

    /* ==========================================================
     * 2) BUY NOW (BELI LANGSUNG)
     * ==========================================================*/
    public function buyNow(Request $request, $bookId)
    {
        $user = Auth::user();
        $qty  = $request->qty;

        $book = Buku::findOrFail($bookId);

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
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment', compact('snapToken', 'order'));
    }

    /* ==========================================================
     * 3) NOTIFICATION / WEBHOOK HANDLER
     * ==========================================================*/
    public function handleNotification(Request $request)
    {
        // Simpan payload mentah untuk debugging
        Log::info("MIDTRANS CALLBACK PAYLOAD: " . json_encode($request->all()));

        $payload = $request->all();
        $orderId = $payload['order_id'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;

        if (!$orderId) {
            Log::error("Midtrans callback tanpa order_id.");
            return response()->json(['error' => 'order_id missing'], 400);
        }

        // Test webhook dari dashboard (opsional)
        if (str_starts_with($orderId, 'payment_notif_test')) {
            Log::info("Webhook TEST diterima. Tidak mengupdate DB.");
            return response()->json(['message' => 'Test callback OK']);
        }

        // OPTIONAL: Validate signature_key (sha512 of order_id + status_code + gross_amount + serverKey)
        // Jika payload tidak punya status_code atau gross_amount, skip validasi.
        if (!empty($signatureKey) && isset($payload['status_code']) && isset($payload['gross_amount'])) {
            $expected = hash('sha512', ($payload['order_id'] ?? '') . ($payload['status_code'] ?? '') . ($payload['gross_amount'] ?? '') . config('midtrans.server_key'));
            if (!hash_equals($expected, $signatureKey)) {
                Log::error("Invalid Midtrans signature for order {$orderId}.");
                return response()->json(['error' => 'invalid signature'], 403);
            }
        }

        // Ambil order (berdasarkan kolom order_id)
        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            Log::error("Order tidak ditemukan: {$orderId}");
            return response()->json(['message' => 'order not found'], 404);
        }

        // Ambil status dari payload / Notification object
        // Gunakan Midtrans Notification jika perlu, tetapi kita utamakan $payload (array) untuk parsing VA.
        $transactionStatus = $payload['transaction_status'] ?? null;
        $paymentType = $payload['payment_type'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;
        $settlementTime = $payload['settlement_time'] ?? null;

        // -----------------------
        // SIMPAN DATA VA / PAYMENT CODE
        // -----------------------
        // Reset default
        $bank = $order->bank;
        $vaNumber = $order->va_number;
        $paymentCode = $order->payment_code;

        // 1) Standard VA (va_numbers array) — $payload guaranteed to be array here
        if (($paymentType === 'bank_transfer' || $paymentType === 'bank_transfer_va') && !empty($payload['va_numbers'][0])) {
            $vaData = $payload['va_numbers'][0];
            $bank = $vaData['bank'] ?? $bank;
            $vaNumber = $vaData['va_number'] ?? $vaNumber;
        }

        // 2) Permata VA (permata_va_number)
        if (!empty($payload['permata_va_number'])) {
            $bank = 'permata';
            $vaNumber = $payload['permata_va_number'];
        }

        // 3) Mandiri Bill Payment (echannel) -> bill_key & biller_code
        if ($paymentType === 'echannel') {
            $bank = 'mandiri';
            $vaNumber = $payload['bill_key'] ?? $vaNumber;
            $paymentCode = $payload['biller_code'] ?? $paymentCode;
        }

        // 4) Be defensive: if payload contains bank & va_number top-level (rare), prefer it
        if (!empty($payload['bank'])) {
            $bank = $payload['bank'];
        }
        if (!empty($payload['va_number'])) {
            $vaNumber = $payload['va_number'];
        }

        // -----------------------
        // UPDATE STATUS ORDER (idempotent)
        // -----------------------
        // Update fields yang kita inginkan
        $order->payment_type = $paymentType;
        $order->transaction_status = $transactionStatus;
        $order->fraud_status = $fraudStatus;

        // Mapping status Midtrans → internal
        if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
            $order->status = 'paid';
            $order->settlement_time = $settlementTime ? date('Y-m-d H:i:s', strtotime($settlementTime)) : now();
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $order->status = 'failed';
        } elseif ($transactionStatus === 'pending') {
            $order->status = 'pending';
        }

        // Simpan VA fields (jika ada perubahan)
        $order->bank = $bank;
        $order->va_number = $vaNumber;
        $order->payment_code = $paymentCode;

        // Simpan semua
        $order->save();

        // Jika paid (settlement/capture) → hapus keranjang (idempotent)
        if (in_array($transactionStatus, ['settlement', 'capture'])) {
            Keranjang::where('user_id', $order->user_id)->delete();
            Log::info("Keranjang dihapus untuk user_id: {$order->user_id}");
        }

        // Log ringkasan (bantu debugging)
        Log::info("ORDER UPDATED: " . json_encode([
            'order_id' => $order->order_id,
            'status' => $order->status,
            'payment_type' => $order->payment_type,
            'transaction_status' => $order->transaction_status,
            'fraud_status' => $order->fraud_status,
            'bank' => $order->bank,
            'va_number' => $order->va_number,
            'payment_code' => $order->payment_code,
            'settlement_time' => $order->settlement_time,
        ]));

        return response()->json(['message' => 'Notification processed']);
    }
}
