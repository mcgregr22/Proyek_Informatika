<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('koleksi', function (Blueprint $table) {
            $table->id('id_koleksi'); // BIGINT UNSIGNED AI

            // relasi ke users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // SAMA dengan _buku.id_buku (INT SIGNED)
            $table->integer('id_buku');

            $table->unsignedInteger('qty')->default(1);

            $table->enum('access_status', ['saved','owned'])->default('saved');

            $table->dateTime('koleksi_date')->useCurrent();
            $table->dateTime('purchased_at')->nullable();

            $table->timestamps();

            // unik per user x buku
            $table->unique(['user_id','id_buku'], 'uniq_user_buku');

            // index bantu
            $table->index('id_buku');
        });

        // Tambahkan FK setelah create (lebih eksplisit)
        Schema::table('koleksi', function (Blueprint $table) {
            $table->foreign('id_buku')
                  ->references('id_buku')
                  ->on('_buku')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koleksi');
    }
};
