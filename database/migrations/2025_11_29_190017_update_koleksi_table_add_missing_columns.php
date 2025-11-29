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
    Schema::table('koleksi', function (Blueprint $table) {

        // tambah id_buku (FK ke _buku)
        $table->unsignedBigInteger('id_buku')->after('user_id');
        $table->foreign('id_buku')->references('id_buku')->on('_buku')->onDelete('cascade');

        // qty
        $table->integer('qty')->default(1)->after('id_buku');

        // access_status
        $table->string('access_status')->default('private')->after('qty');

        // koleksi_date
        $table->timestamp('koleksi_date')->nullable()->after('access_status');
    });
}

public function down()
{
    Schema::table('koleksi', function (Blueprint $table) {
        $table->dropForeign(['id_buku']);
        $table->dropColumn(['id_buku', 'qty', 'access_status', 'koleksi_date']);
    });
}

};
