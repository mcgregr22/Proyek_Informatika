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

    /** Relasi ke buku yang diminta */
    public function requestedBook()
    {
        return $this->belongsTo(\App\Models\Buku::class, 'requested_book_id', 'id_buku');
    }

    /** Relasi ke buku yang ditawarkan */
    public function offeredBook()
    {
        return $this->belongsTo(\App\Models\Buku::class, 'offered_book_id', 'id_buku');
    }

    /** ⬇️ Tambahan: relasi ke user pengaju (requester) */
    public function requester()
    {
        return $this->belongsTo(\App\Models\User::class, 'requester_id');
    }

    /** ⬇️ Tambahan: relasi ke user pemilik buku (owner) */
    public function owner()
    {
        return $this->belongsTo(\App\Models\User::class, 'owner_id');
    }
}