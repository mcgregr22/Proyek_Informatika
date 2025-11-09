<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('koleksi', function (Blueprint $table) {
            // Pastikan tipe kolom id_buku sama seperti di tabel _buku
            // yaitu unsignedBigInteger
            if (!Schema::hasColumn('koleksi', 'id_buku')) {
                $table->unsignedBigInteger('id_buku')->nullable()->after('user_id');
            } else {
                // Jika kolom sudah ada, ubah tipe datanya agar cocok
                $table->unsignedBigInteger('id_buku')->change();
            }

            // Tambahkan foreign key (pastikan tidak duplikat)
            $table->foreign('id_buku')
                ->references('id_buku')
                ->on('_buku')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('koleksi', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['id_buku']);
        });
    }
};
