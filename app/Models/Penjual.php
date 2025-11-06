<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    use HasFactory;

    protected $table = 'penjual';
    protected $primaryKey = 'id_penjual';

    protected $fillable = [
        'username',
        'password',
        'email',
        'no_telepon',
        'KTP',
    ];
}
    