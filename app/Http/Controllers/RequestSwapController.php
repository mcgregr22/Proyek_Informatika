<?php

namespace App\Http\Controllers;

use App\Models\SwapRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestSwapController extends Controller
{
    /**
     * Daftar permintaan masuk & keluar.
     */
    public function index()
    {
        $uid = Auth::id();

        $incomingRequests = SwapRequest::with(['requester','requestedBook','offeredBook'])
            ->where('owner_id', $uid)
            ->latest()->get();

        $outgoingRequests = SwapRequest::with(['owner','requestedBook','offeredBook'])
            ->where('requester_id', $uid)
            ->latest()->get();

        return view('request_swap', compact('incomingRequests', 'outgoingRequests'));
    }

    /**
     * Kirim permintaan tukar buku.
     * expects: requested_book_id (buku target), offered_book_id (buku milik requester), optional message
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'requested_book_id' => 'required|integer|exists:_buku,id_buku',
            'offered_book_id'   => 'required|integer|exists:_buku,id_buku',
            'message'           => 'nullable|string|max:500',
        ]);

        $requesterId = Auth::id();
        $requestedId = (int) $data['requested_book_id'];
        $offeredId   = (int) $data['offered_book_id'];

        // pastikan offered book ada di koleksi requester
        $owned = DB::table('koleksi')
            ->where('user_id', $requesterId)
            ->where('id_buku', $offeredId)
            ->exists();

        if (!$owned) {
            return back()->with('error', 'Buku yang Anda tawarkan tidak ada di koleksi Anda.');
        }

        // owner buku yang diminta
        $ownerId = (int) DB::table('_buku')->where('id_buku', $requestedId)->value('user_id');
        if (!$ownerId) {
            return back()->with('error', 'Buku target tidak ditemukan.');
        }
        if ($ownerId === $requesterId) {
            return back()->with('error', 'Tidak bisa menukar dengan buku milik sendiri.');
        }

        // opsi: cek ketersediaan swap
        $okRequested = DB::table('_buku')
            ->where('id_buku', $requestedId)
            ->where('is_available_for_swap', true)
            ->where('status_buku', 'available')
            ->exists();

        $okOffered = DB::table('_buku')
            ->where('id_buku', $offeredId)
            ->where('is_available_for_swap', true)
            ->where('status_buku', 'available')
            ->exists();

        if (!$okRequested || !$okOffered) {
            return back()->with('error', 'Salah satu buku tidak tersedia untuk ditukar.');
        }

        // cegah duplikasi pending
        $duplicate = SwapRequest::where([
            'requested_book_id' => $requestedId,
            'offered_book_id'   => $offeredId,
            'requester_id'      => $requesterId,
            'owner_id'          => $ownerId,
        ])->where('status', 'pending')->exists();

        if ($duplicate) {
            return back()->with('error', 'Permintaan serupa sedang menunggu.');
        }

        SwapRequest::create([
            'requested_book_id' => $requestedId,
            'offered_book_id'   => $offeredId,
            'requester_id'      => $requesterId,
            'owner_id'          => $ownerId,
            'status'            => 'pending',
            'is_read'           => false,
            'message'           => $data['message'] ?? null,
        ]);

        return redirect()->route('pengelolaan.swapbook')
            ->with('success', 'Permintaan tukar terkirim. Menunggu respon pemilik.');
    }

    /**
     * Terima permintaan (hanya owner yang boleh).
     */
    public function accept($id)
    {
        $uid = Auth::id();
        $req = SwapRequest::findOrFail($id);

        if ((int)$req->owner_id !== (int)$uid) {
            abort(403, 'Tidak berwenang.');
        }

        $req->update(['status' => 'accepted', 'is_read' => true]);

        // Opsional: update status buku
        // DB::table('_buku')->whereIn('id_buku', [$req->requested_book_id, $req->offered_book_id])
        //   ->update(['status_buku' => 'pending']);

        return response()->json(['success' => true]);
    }

    /**
     * Tolak permintaan (hanya owner yang boleh).
     */
    public function reject($id)
    {
        $uid = Auth::id();
        $req = SwapRequest::findOrFail($id);

        if ((int)$req->owner_id !== (int)$uid) {
            abort(403, 'Tidak berwenang.');
        }

        $req->update(['status' => 'rejected', 'is_read' => true]);
        return response()->json(['success' => true]);
    }

    /**
     * (Opsional) Batalkan oleh requester.
     */
    public function cancel($id)
    {
        $uid = Auth::id();
        $req = SwapRequest::findOrFail($id);

        if ((int)$req->requester_id !== (int)$uid) {
            abort(403, 'Tidak berwenang.');
        }

        $req->update(['status' => 'cancelled']);
        return back()->with('success', 'Permintaan dibatalkan.');
    }
}
