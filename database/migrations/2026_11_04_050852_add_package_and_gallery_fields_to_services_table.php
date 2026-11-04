<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->decimal('plus_price', 12, 2)->nullable();
            $table->decimal('premium_price', 12, 2)->nullable();
            $table->json('basic_features')->nullable();
            $table->json('plus_features')->nullable();
            $table->json('premium_features')->nullable();
            $table->string('main_image')->nullable();
            $table->json('gallery_images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'plus_price',
                'premium_price',
                'basic_features',
                'plus_features',
                'premium_features',
                'main_image',
                'gallery_images',
            ]);
        });
    }
};
