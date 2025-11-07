<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('_buku', function (Blueprint $table) {
            // ID Buku (INT biasa)
          $table->id('id_buku'); // otomatis auto increment primary key


            // Relasi ke kategori (jika ada)
            $table->integer('id_kategori')->nullable();

            // Pemilik buku (user)
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();

            // Informasi utama buku
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('cover_image')->nullable();
            $table->decimal('harga', 10, 2)->nullable();

            // Kolom tambahan untuk fitur swap book
            $table->boolean('is_available_for_swap')->default(false);
            $table->enum('status_buku', ['available', 'pending', 'swapped'])->default('available');

            // Waktu pembuatan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('_buku');
    }
};
