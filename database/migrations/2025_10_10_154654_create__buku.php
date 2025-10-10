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
        Schema::create('_buku', function (Blueprint $table) {
            $table->integer('id_buku');
            $table->integer('id_kategori');
         $table->String('title');
          $table->string('author');
            $table->string('isbn');
            $table->text('deskripsi');
            $table->string('cover_image');
            $table->decimal('harga');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_buku');
    }
};
