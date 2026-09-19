<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('category_name');
            $table->string('slug')->unique();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('freelancer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 12, 2);
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('caption');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('service_id')->constrained('services')->restrictOnDelete();
            $table->enum('status', ['MENUNGGU', 'DIPROSES', 'SUBMITTED', 'REVISI', 'SELESAI'])
                ->default('MENUNGGU');
            $table->string('work_result_file')->nullable();
            $table->text('revision_notes')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['client', 'freelancer', 'admin'])->default('client')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('client')->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['service_id']);
            $table->dropColumn(['client_id', 'service_id', 'status', 'work_result_file', 'revision_notes']);
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id', 'file_path', 'caption']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['freelancer_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['freelancer_id', 'category_id', 'title', 'description', 'price']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['category_name', 'slug']);
        });
    }
};
