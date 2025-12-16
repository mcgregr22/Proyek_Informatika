<?php

namespace App\Http\Controllers;

use App\Models\SwapRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SwapHistoryController extends Controller
{
    public function index()
    {
        // Ambil semua data swap dengan relasi
        $riwayat = SwapRequest::with([
            'requestedBook',
            'offeredBook',
            'requester',
            'owner'
        ])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('swap_history', compact('riwayat'));
    }
    public function userHistory()
    {
        $userId = Auth::id();

        // Ambil riwayat yang melibatkan user (sebagai requester atau owner)
        $riwayat = \App\Models\SwapRequest::with(['requester', 'owner', 'requestedBook', 'offeredBook'])
            ->where('requester_id', $userId)
            ->orWhere('owner_id', $userId)
            ->latest()
            ->get();

        return view('swap_history_user', compact('riwayat'));
    }
}
