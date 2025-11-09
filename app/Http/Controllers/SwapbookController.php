<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Buku;
use App\Models\SwapRequest;

class SwapbookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** GET /swapbook — halaman Tukar Buku (Masuk/Keluar) */
    public function index()
    {
        $uid = Auth::id();

        $incoming = SwapRequest::with(['requestedBook','offeredBook','requester','owner'])
            ->where('owner_id', $uid)
            ->latest()
            ->get();

        $outgoing = SwapRequest::with(['requestedBook','offeredBook','requester','owner'])
            ->where('requester_id', $uid)
            ->latest()
            ->get();

        // resources/views/swapbook.blade.php
        return view('swapbook', compact('incoming','outgoing'));
    }

    /** POST /swapbook — kirim permintaan tukar */
    public function store(Request $request)
    {
        $data = $request->validate([
            'requested_book_id' => 'required|integer|exists:_buku,id_buku',
            'offered_book_id'   => 'required|integer|exists:_buku,id_buku',
            'message'           => 'nullable|string|max:255',
        ]);

        $uid       = Auth::id();
        $requested = Buku::where('id_buku', $data['requested_book_id'])->firstOrFail();
        $offered   = Buku::where('id_buku', $data['offered_book_id'])
                         ->where('user_id', $uid)
                         ->firstOrFail();

        if ((int) $requested->user_id === (int) $uid) {
            return back()->with('error', 'Tidak bisa menukar buku milik sendiri.');
        }

        // Cegah duplikasi pending
        $dup = SwapRequest::where([
            'requester_id'      => $uid,
            'owner_id'          => $requested->user_id,
            'requested_book_id' => $requested->id_buku,
            'offered_book_id'   => $offered->id_buku,
        ])->where('status','pending')->exists();

        if ($dup) {
            return back()->with('error','Permintaan serupa sudah ada & masih pending.');
        }

        SwapRequest::create([
            'requested_book_id' => $requested->id_buku,
            'offered_book_id'   => $offered->id_buku,
            'requester_id'      => $uid,
            'owner_id'          => $requested->user_id,
            'status'            => 'pending',
            'is_read'           => false,
            'message'           => $data['message'] ?? null,
        ]);

        return redirect()->route('swap.index')->with('success','Permintaan tukar dikirim.');
    }

    /** PATCH /swap/requests/{swap}/accept — owner menyetujui, koleksi ditukar */
    public function accept(SwapRequest $swap)
{
    // Hanya pemilik buku requested yang boleh menerima
    if ($swap->owner_id !== Auth::id()) {
        abort(Response::HTTP_FORBIDDEN, 'Tidak berhak.');
    }
    if ($swap->status !== 'pending') {
        return back()->with('error', 'Permintaan sudah tidak pending.');
    }

    try {
        DB::transaction(function () use ($swap) {
            // Kunci baris buku agar aman dari balapan
            $requestedBook = DB::table('_buku')
                ->where('id_buku', $swap->requested_book_id)
                ->lockForUpdate()
                ->first();

            $offeredBook = DB::table('_buku')
                ->where('id_buku', $swap->offered_book_id)
                ->lockForUpdate()
                ->first();

            if (!$requestedBook || !$offeredBook) {
                throw new \RuntimeException('Buku tidak ditemukan.');
            }

            // Validasi kepemilikan masih sesuai dengan swap yang pending
            if ((int)$requestedBook->user_id !== (int)$swap->owner_id ||
                (int)$offeredBook->user_id   !== (int)$swap->requester_id) {
                throw new \RuntimeException('Kepemilikan buku sudah berubah.');
            }

            // Pindahkan requested_book ke requester
            $aff1 = DB::table('_buku')
                ->where('id_buku', $swap->requested_book_id)
                ->update(['user_id' => $swap->requester_id]);

            // Pindahkan offered_book ke owner
            $aff2 = DB::table('_buku')
                ->where('id_buku', $swap->offered_book_id)
                ->update(['user_id' => $swap->owner_id]);

            if ($aff1 < 1 || $aff2 < 1) {
                throw new \RuntimeException('Gagal memperbarui kepemilikan buku.');
            }

            // Tandai swap diterima
            DB::table('swap_requests')
                ->where('id', $swap->id)
                ->update([
                    'status'     => 'accepted',
                    'is_read'    => true,
                    'updated_at' => now(),
                ]);

            // (opsional) auto-reject semua pending lain yang melibatkan buku-buku ini
            DB::table('swap_requests')
                ->where('id', '!=', $swap->id)
                ->where('status', 'pending')
                ->where(function ($q) use ($swap) {
                    $q->whereIn('requested_book_id', [$swap->requested_book_id, $swap->offered_book_id])
                      ->orWhereIn('offered_book_id',   [$swap->requested_book_id, $swap->offered_book_id]);
                })
                ->update(['status' => 'rejected', 'is_read' => true, 'updated_at' => now()]);
        });
    } catch (\Throwable $e) {
        return back()->with('error', 'Gagal menyetujui: '.$e->getMessage());
    }

    return back()->with('success', 'Tukar buku disetujui. Koleksi sudah diperbarui.');
}

    /** PATCH /swap/requests/{swap}/reject — owner menolak */
    public function reject(SwapRequest $swap)
    {
        if ($swap->owner_id !== Auth::id()) {
            abort(Response::HTTP_FORBIDDEN, 'Tidak berhak.');
        }
        if ($swap->status !== 'pending') {
            return back()->with('error', 'Permintaan sudah tidak pending.');
        }

        $swap->update([
            'status'  => 'rejected',
            'is_read' => true,
        ]);

        return back()->with('success', 'Permintaan ditolak.');
    }
}
