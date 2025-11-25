<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('swap_requests', function (Blueprint $table) {
            // Primary key auto increment
            $table->id();

            $table->unsignedBigInteger('requested_book_id');
            $table->unsignedBigInteger('offered_book_id')->nullable();


            // User yang mengajukan permintaan
            $table->foreignId('requester_id')->constrained('users')->cascadeOnDelete();

            // User pemilik buku yang diminta
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();

            // Status permintaan
            $table->enum('status', ['pending', 'accepted', 'rejected', 'cancelled'])->default('pending');

            // Penanda notifikasi dibaca/belum
            $table->boolean('is_read')->default(false);

            // Pesan tambahan opsional
            $table->string('message', 255)->nullable();

            $table->timestamps();

            // Foreign key relasi buku
            $table->foreign('requested_book_id')
                ->references('id_buku')->on('_buku')
                ->cascadeOnDelete();

            $table->foreign('offered_book_id')
                ->references('id_buku')->on('_buku')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('swap_requests');
    }
};
