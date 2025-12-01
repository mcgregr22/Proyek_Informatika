<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
    protected $fillable = [
        'order_id',
        'id_buku',
        'qty',
        'harga'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function buku()
    {
        return $this->belongsTo(\App\Models\Buku::class, 'id_buku');
    }
}