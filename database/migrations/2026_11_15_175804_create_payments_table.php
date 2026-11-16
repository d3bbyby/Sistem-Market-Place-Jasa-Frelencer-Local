<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('client_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->decimal('amount', 12, 2);

            $table->enum('payment_method', [
                'transfer',
                'ewallet',
                'cash'
            ])->nullable();

            $table->enum('status', [
                'MENUNGGU',
                'BERHASIL',
                'GAGAL'
            ])->default('MENUNGGU');

            $table->string('payment_proof')->nullable();

            $table->timestamps();

            $table->unique('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};