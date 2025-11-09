<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = '_buku';
    protected $primaryKey = 'id_buku';

    // di migration kamu tidak set auto-increment & timestamps
    public $incrementing = true ; // ubah ke true kalau nanti kolom id_buku dibuat auto-increment
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_buku',
    'id_kategori',
    'title',
    'author',
    'isbn',
    'deskripsi',
    'cover_image',
    'harga',
    'listing_type',
    'user_id',
    'tanggal_rilis',
    'penerbit',
    'bahasa'
    ];

    

    // helper kecil buat format harga (opsional dipakai di Blade)
    public function getHargaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function koleksi()
    {
        return $this->hasMany(Koleksi::class, 'id_buku', 'id_buku');
    }


}