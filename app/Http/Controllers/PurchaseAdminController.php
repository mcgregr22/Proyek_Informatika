<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;

class PurchaseAdminController extends Controller
{
    public function index()
{
    $transactions = Order::with(['user', 'items.buku'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('purchase_admin', compact('transactions'));
}

}
