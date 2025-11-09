<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    use HasFactory;

    protected $table = 'koleksi';
    protected $primaryKey = 'id_koleksi';

    protected $fillable = [
        'user_id',
        'id_buku',
        'qty',
        'access_status',
        'koleksi_date',
        'purchased_at',
    ];

    // 🔹 Relasi ke tabel Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    // 🔹 Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
