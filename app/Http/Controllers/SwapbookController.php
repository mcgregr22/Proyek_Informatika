<?php
namespace App\Http\Controllers;

use App\Models\SwapRequest;
use Illuminate\Support\Facades\Auth;

class SwapbookController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $incoming = SwapRequest::with(['requester','requestedBook','offeredBook'])
            ->where('owner_id', $userId)->latest()->get();

        $outgoing = SwapRequest::with(['owner','requestedBook','offeredBook'])
            ->where('requester_id', $userId)->latest()->get();

        return view('swapbook', compact('incoming','outgoing'));
    }
}
