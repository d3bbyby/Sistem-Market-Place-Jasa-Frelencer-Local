<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            if (!Schema::hasColumn('ratings', 'order_id')) {
                $table->foreignId('order_id')
                    ->constrained('orders')
                    ->cascadeOnDelete();
            }

            if (!Schema::hasColumn('ratings', 'reviewer_id')) {
                $table->foreignId('reviewer_id')
                    ->constrained('users')
                    ->cascadeOnDelete();
            }

            if (!Schema::hasColumn('ratings', 'reviewed_id')) {
                $table->foreignId('reviewed_id')
                    ->constrained('users')
                    ->cascadeOnDelete();
            }

            if (!Schema::hasColumn('ratings', 'rating')) {
                $table->unsignedTinyInteger('rating');
            }

            if (!Schema::hasColumn('ratings', 'review')) {
                $table->text('review')->nullable();
            }

            $table->unique(['order_id', 'reviewer_id']);
        });
    }

    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropUnique(['order_id', 'reviewer_id']);
            $table->dropForeign(['order_id']);
            $table->dropForeign(['reviewer_id']);
            $table->dropForeign(['reviewed_id']);

            $table->dropColumn([
                'order_id',
                'reviewer_id',
                'reviewed_id',
                'rating',
                'review',
            ]);
        });
    }
};
