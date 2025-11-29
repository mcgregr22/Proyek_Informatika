<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id(); // primary key: 'id' (unsigned BIGINT)
            // relasi ke tabel 'pengguna' (ganti ke 'users' kalau pakai tabel users bawaan laravel)
            $table->foreignId('pengguna_id')
                  ->constrained('pengguna')
                  ->cascadeOnDelete();

            $table->string('title', 200);
            $table->string('slug', 220)->unique(); // opsional tapi disarankan untuk URL
            $table->text('content');
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // index untuk pencarian cepat
            $table->index(['pengguna_id', 'created_at']);
        });

        // (opsional) fulltext index untuk title+content jika MySQL-mu mendukung
        // DB::statement('ALTER TABLE forum_posts ADD FULLTEXT fulltext_title_content (title, content)');
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_posts');
    }
};
