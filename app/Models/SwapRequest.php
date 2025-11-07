<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwapRequest extends Model
{
    protected $table = 'swap_requests';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    // Kolom yang bisa diisi lewat mass assignment
    protected $fillable = [
        'requested_book_id',   // buku yang ingin ditukar (punya orang lain)
        'offered_book_id',     // buku yang ditawarkan (punya requester)
        'requester_id',        // user yang mengajukan tukar
        'owner_id',            // pemilik buku yang diminta
        'status',              // pending, accepted, rejected, cancelled
        'is_read',             // notifikasi dibaca/belum
        'message',             // pesan opsional
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* ====================== RELATIONSHIPS ====================== */

    // 📘 Buku yang diminta
    public function requestedBook()
    {
        return $this->belongsTo(Buku::class, 'requested_book_id', 'id_buku');
    }

    // 📗 Buku yang ditawarkan
    public function offeredBook()
    {
        return $this->belongsTo(Buku::class, 'offered_book_id', 'id_buku');
    }

    // 👤 User yang meminta tukar
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id', 'id');
    }

    // 👤 Pemilik buku yang diminta
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /* ====================== SCOPES / HELPERS ====================== */

    // 🔍 Scope untuk status tertentu
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // 💬 Helper kecil buat tampilan status (misal untuk badge di UI)
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'Menunggu Konfirmasi',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
            'cancelled'=> 'Dibatalkan',
            default    => ucfirst($this->status),
        };
    }
}
