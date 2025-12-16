<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;  // ← WAJIB
use App\Models\User;       // ← WAJIB

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'total',
        'status',
        'payment_type',
        'transaction_status',
        'fraud_status',
        'bank',
        'va_number',
        'payment_code',
        'settlement_time',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
