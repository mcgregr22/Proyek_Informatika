<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_type')->nullable();
            $table->string('transaction_status')->nullable(); // settlement, pending, cancel
            $table->string('fraud_status')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();
            $table->string('payment_code')->nullable();
            $table->timestamp('settlement_time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_type',
                'transaction_status',
                'fraud_status',
                'bank',
                'va_number',
                'payment_code',
                'settlement_time',
            ]);
        });
    }
};
