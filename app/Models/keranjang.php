<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $fillable = ['user_id','id_buku','qty','harga'];

    public function buku()
    {
        return $this->belongsTo(\App\Models\Buku::class, 'id_buku', 'id_buku');
    }
}
