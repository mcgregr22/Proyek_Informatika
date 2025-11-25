<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // ambil ID user login

        $transactions = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'orders.id',
                'orders.order_id',
                'users.name as user_name',
                'orders.total',
                'orders.status',
                'orders.created_at'
            )
            ->where('orders.user_id', $userId) // <-- FILTER USER LOGIN
            ->orderBy('orders.created_at', 'desc')
            ->get();

        return view('purchase', compact('transactions'));
    }
}
