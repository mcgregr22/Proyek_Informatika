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
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id('id_post');
            $table->foreignId('id_pengguna')->constrained('pengguna')->onDelete('cascade');  // Relasi dengan pengguna
            $table->string('title', 200);
            $table->text('content');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::dropIfExists('forum_posts');
    }
};