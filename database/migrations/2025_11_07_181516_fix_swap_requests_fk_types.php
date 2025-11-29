<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    // Cek dulu: kalau foreign key belum ada, skip aja
    Schema::table('swap_requests', function (Blueprint $table) {
        // Ubah tipe kolom langsung (tanpa drop FK)
        // karena sebelumnya FK belum pernah dibuat
        $table->integer('requested_book_id')->change();
        $table->integer('offered_book_id')->nullable()->change();

        // Buat FK baru (aman walau sebelumnya gak ada)
        $table->foreign('requested_book_id')
              ->references('id_buku')->on('_buku')
              ->cascadeOnDelete();
        $table->foreign('offered_book_id')
              ->references('id_buku')->on('_buku')
              ->cascadeOnDelete();
    });
}

 public function down(): void
{
    Schema::table('swap_requests', function (Blueprint $table) {
        if (Schema::hasColumn('swap_requests', 'requested_book_id')) {
            $table->dropForeign(['requested_book_id']);
        }
        if (Schema::hasColumn('swap_requests', 'offered_book_id')) {
            $table->dropForeign(['offered_book_id']);
        }

        $table->unsignedInteger('requested_book_id')->change();
        $table->unsignedInteger('offered_book_id')->nullable()->change();
    });
}
};