<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id('id_post'); // Primary Key: id_post
            $table->string('title', 255); // Ganti 'tittle' jadi 'title' agar konsisten
            $table->text('content'); // Isi konten post

            // Relasi ke tabel users (1 user bisa punya banyak post)
            $table->foreignId('user_id')
                  ->constrained('users') // default references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Timestamps otomatis: created_at & updated_at
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_posts');
    }
};
