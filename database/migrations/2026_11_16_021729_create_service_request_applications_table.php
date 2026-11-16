<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_request_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_request_id')
                ->constrained('service_requests')
                ->cascadeOnDelete();

            $table->foreignId('freelancer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->text('message')->nullable();

            $table->string('status')->default('pending');

            $table->timestamps();

            $table->unique(
            ['service_request_id', 'freelancer_id'],
            'request_freelancer_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_request_applications');
    }
};
