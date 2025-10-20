<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id(); // id keranjang item (auto increment)
            
            // user id tetap pakai foreignId (wajib login)
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // SAMA DENGAN _buku.id_buku = integer (SIGNED, TANPA FK)
            $table->integer('id_buku');

            $table->integer('qty')->default(1);
            $table->integer('harga');

            $table->timestamps();

            // Pastikan user tidak menggandakan buku yang sama
            $table->unique(['user_id', 'id_buku']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
