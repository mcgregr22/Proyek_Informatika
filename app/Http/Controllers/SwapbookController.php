<?php

// app/Http/Controllers/SwapbookController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\SwapRequest;

class SwapbookController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'requested_book_id' => 'required|integer|exists:_buku,id_buku',
            'offered_book_id'   => 'required|integer|exists:_buku,id_buku', // jadikan required bila harus pilih buku
            'message'           => 'nullable|string|max:255',
        ]);

        $uid       = Auth::id();
        $requested = Buku::where('id_buku', $data['requested_book_id'])->firstOrFail();
        $offered   = Buku::where('id_buku', $data['offered_book_id'])
                        ->where('user_id', $uid)->firstOrFail();

        if ((int)$requested->user_id === (int)$uid) {
            return back()->with('error', 'Tidak bisa menukar buku milik sendiri.');
        }

        // Cegah duplikasi pending
        $dup = SwapRequest::where([
                    'requester_id'      => $uid,
                    'owner_id'          => $requested->user_id,
                    'requested_book_id' => $requested->id_buku,
                    'offered_book_id'   => $offered->id_buku,
                ])->where('status','pending')->exists();

        if ($dup) return back()->with('error','Permintaan serupa sudah ada & masih pending.');

        SwapRequest::create([
            'requested_book_id' => $requested->id_buku,
            'offered_book_id'   => $offered->id_buku,
            'requester_id'      => $uid,
            'owner_id'          => $requested->user_id, // → ini yang bikin muncul di "Masuk" user pemilik buku
            'status'            => 'pending',
            'is_read'           => false,
            'message'           => $data['message'] ?? null,
        ]);

        return redirect()->route('pengelolaan.swapbook')
            ->with('success','Permintaan tukar dikirim.');
    }
}
