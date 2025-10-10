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
        Schema::create('_koleksi', function (Blueprint $table) {
    $table->increments('id_koleksi');
    $table->integer('id_customer');
    $table->integer('total_buku');
    $table->dateTime('koleksi_date');
});
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('_koleksi');
    }
};
