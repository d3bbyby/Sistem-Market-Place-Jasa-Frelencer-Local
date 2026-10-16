<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('client_id')
                ->after('id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('service_id')
                ->after('client_id')
                ->constrained('services')
                ->restrictOnDelete();

            $table->decimal('total_price', 12, 2)
                ->after('service_id');

            $table->string('status')
                ->default('pending')
                ->after('total_price');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['service_id']);

            $table->dropColumn([
                'client_id',
                'service_id',
                'total_price',
                'status',
            ]);
        });
    }
};