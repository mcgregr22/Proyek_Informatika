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
        Schema::create('forum_comments', function (Blueprint $table) {
            $table->id('id_comment'); // Primary Key
            $table->text('komentar'); // Isi komentar

            // Relasi ke forum_posts (Many-to-One)
            $table->foreignId('id_post')
                  ->constrained('forum_posts', 'id_post') // Menyesuaikan nama kolom PK di forum_posts
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Relasi ke users (Many-to-One)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // (Opsional) Nested comment
            // $table->foreignId('parent_comment_id')->nullable()
            //       ->constrained('forum_comments', 'id_comment')
            //       ->onDelete('cascade')
            //       ->onUpdate('cascade');

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        // Drop tabel dengan aman
        Schema::dropIfExists('forum_comments');
    }
};
