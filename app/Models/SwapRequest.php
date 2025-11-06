<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwapRequest extends Model
{
    protected $table = 'swap_requests';   // nama tabel
    protected $primaryKey = 'id';         // ubah jika PK kamu bukan 'id'
    public $incrementing = true;
    protected $keyType = 'int';

    // set true kalau tabel punya created_at/updated_at (biasanya iya)
    public $timestamps = true;

    // kolom yang boleh diisi mass assignment (sesuaikan dengan tabelmu)
    protected $fillable = [
        'user_id',        // peminta tukar
        'book_id',        // refer ke _buku.id_buku
        'target_user_id', // opsional: pemilik buku yang dituju (kalau ada)
        'status',         // pending/accepted/rejected/cancelled (sesuaikan)
        'message',        // pesan opsional
        'requested_at',   // opsional kalau kamu punya kolom ini
    ];

    protected $casts = [
        'requested_at' => 'datetime',
    ];

    /* ====================== RELATIONSHIPS ====================== */

    // buku yang diminta tukar
    public function buku()
    {
        // foreignKey di swap_requests = book_id
        // ownerKey di parent (_buku)    = id_buku
        return $this->belongsTo(Buku::class, 'book_id', 'id_buku');
    }

    // user yang mengajukan permintaan (asumsi pakai model bawaan User)
    public function requester()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    // (opsional) user pemilik buku yang dituju
    public function targetUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'target_user_id', 'id');
    }
}
