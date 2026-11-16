<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('order_id')
                ->after('id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('client_id')
                ->after('order_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('freelancer_id')
                ->after('client_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->unique('order_id');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropUnique(['order_id']);
            $table->dropConstrainedForeignId('freelancer_id');
            $table->dropConstrainedForeignId('client_id');
            $table->dropConstrainedForeignId('order_id');
        });
    }
};