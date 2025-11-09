<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $fillable = [
        'user_id',
        'book_id',
        'qty',
        'total',
        'address',
        'payment_method',
        'status',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke buku
    public function book()
    {
        return $this->belongsTo(Buku::class, 'book_id', 'id_buku');
    }
}
