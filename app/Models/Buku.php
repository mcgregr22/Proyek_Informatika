<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Buku extends Model
{
    protected $table      = '_buku';   // ganti ke 'buku' kalau tabelmu tanpa underscore
    protected $primaryKey = 'id_buku';
    public $incrementing  = true;
    protected $keyType    = 'int';
    public $timestamps    = false;

    protected $fillable = [
        'id_kategori',
        'title',
        'author',
        'isbn',
        'deskripsi',
        'cover_image',
        'harga',
        'listing_type',
        'tanggal_rilis',
        'penerbit',
        'bahasa',
        'user_id',
    ];

    protected $casts = [
        'id_buku'     => 'integer',
        'id_kategori' => 'integer',
        'user_id'     => 'integer',
        'harga'       => 'integer',
    ];

    /** Relations */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Accessors */
    public function getHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format((int) $this->harga, 0, ',', '.');
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image
            ? Storage::url($this->cover_image)
            : null;
    }

    /** Scopes */
    public function scopeSearch($q, ?string $term)
    {
        $term = trim((string) $term);
        if ($term === '') return $q;

        return $q->where(function ($x) use ($term) {
            $x->where('title',  'like', "%{$term}%")
              ->orWhere('author','like', "%{$term}%")
              ->orWhere('isbn',  'like', "%{$term}%");
        });
    }

    public function scopeWithCover($q)
    {
        return $q->whereNotNull('cover_image')->where('cover_image', '!=', '');
    }
}