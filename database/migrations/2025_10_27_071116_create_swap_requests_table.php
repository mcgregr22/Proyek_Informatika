<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('swap_requests', function (Blueprint $table) {
            $table->id();

            // HARUS INT SIGNED (match _buku.id_buku)
            $table->integer('book_id');

            // MATCH users.id (BIGINT UNSIGNED)
            $table->foreignId('requester_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();

            $table->enum('status', ['pending','accepted','rejected'])->default('pending');
            $table->boolean('is_read')->default(false);

            $table->timestamps();
        });

        // lalu tambahkan FK setelah tabel terbentuk.
        DB::statement('ALTER TABLE swap_requests MODIFY book_id INT NOT NULL');
        DB::statement('ALTER TABLE swap_requests
            ADD CONSTRAINT swap_requests_book_id_foreign
            FOREIGN KEY (book_id) REFERENCES _buku(id_buku)
            ON DELETE CASCADE');
    }

    public function down(): void
    {
        Schema::dropIfExists('swap_requests');
    }
};