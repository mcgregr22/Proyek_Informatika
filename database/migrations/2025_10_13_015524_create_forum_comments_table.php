<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::create('forum_comments', function (Blueprint $table) {
            $table->id('id_comment');
            $table->foreignId('id_post')->constrained('forum_posts');
            $table->foreignId('id_pengguna')->constrained('pengguna');
            $table->text('komentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
      public function down(): void
    {
        Schema::dropIfExists('forum_comments');
    }
};