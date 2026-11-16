<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->cascadeOnDelete();

            $table->foreignId('freelancer_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['client_id', 'service_id']);
            $table->unique(['client_id', 'freelancer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};