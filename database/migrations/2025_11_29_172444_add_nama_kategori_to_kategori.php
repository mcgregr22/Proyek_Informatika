<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('kategori', function (Blueprint $table) {
        $table->string('nama_kategori')->after('id');
    });
}

public function down()
{
    Schema::table('kategori', function (Blueprint $table) {
        $table->dropColumn('nama_kategori');
    });
}

};
