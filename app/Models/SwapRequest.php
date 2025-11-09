<?php
// app/Models/SwapRequest.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwapRequest extends Model
{
    protected $table = 'swap_requests';

    protected $fillable = [
        'requested_book_id',   // FK ke _buku.id_buku
        'offered_book_id',     // FK ke _buku.id_buku (nullable)
        'requester_id',        // users.id (pengaju)
        'owner_id',            // users.id (pemilik buku diminta)
        'status',              // pending/accepted/rejected/cancelled
        'is_read',             // notif sudah dibaca?
        'message',
    ];

    protected $casts = [
        'requested_book_id' => 'integer',
        'offered_book_id'   => 'integer',
        'requester_id'      => 'integer',
        'owner_id'          => 'integer',
        'is_read'           => 'boolean',
    ];

    public function requestedBook()
    {
        return $this->belongsTo(\App\Models\Buku::class, 'requested_book_id', 'id_buku');
    }

    public function offeredBook()
    {
        return $this->belongsTo(\App\Models\Buku::class, 'offered_book_id', 'id_buku');
    }
}
