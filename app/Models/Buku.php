<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Buku extends Model
{
    /** ================== BASIC CONFIG ================== */
    // ganti ke 'buku' kalau nama tabelmu tanpa underscore
    protected $table = '_buku';

    protected $primaryKey = 'id_buku';
    public $incrementing  = true;   // pastikan kolom id_buku AUTO_INCREMENT di DB
    protected $keyType    = 'int';

    // set true kalau tabelmu punya created_at/updated_at
    public $timestamps    = false;

    /** ================== MASS ASSIGNMENT ================== */
    protected $fillable = [
        'id_kategori',
        'title',
        'author',
        'isbn',
        'deskripsi',
        'cover_image',
        'harga',
    ];

    /** ================== RELATIONS ================== */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // NOTE: tabel BookClick belum ada—hapus/aktifkan nanti kalau sudah siap.
    // public function clicks()
    // {
    //     return $this->hasMany(\App\Models\BookClick::class, 'book_id', 'id_buku');
    // }

    // Kalau swap_requests benar-benar dipakai dan tabelnya ada:
    // public function swapRequests()
    // {
    //     return $this->hasMany(SwapRequest::class, 'book_id', 'id_buku');
    // }

    /** ================== ACCESSORS ================== */
    // Rp 12.345
    public function getHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format((int) $this->harga, 0, ',', '.');
    }

    // URL cover dari Storage (butuh `php artisan storage:link`)
    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image
            ? Storage::url($this->cover_image)   // hasilnya "/storage/...."
            : null; // atau ganti ke asset('images/default-book.png')
    }

    /** ================== SCOPES (opsional enak dipakai) ================== */
    // Scope pencarian judul/penulis/isbn
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

    // Hanya buku yang punya cover
    public function scopeWithCover($q)
    {
        return $q->whereNotNull('cover_image')->where('cover_image', '!=', '');
    }
}
