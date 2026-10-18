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
        if (! Schema::hasColumn('orders', 'total_price')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->decimal('total_price', 12, 2)->nullable()->after('service_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('orders', 'total_price')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('total_price');
            });
        }
    }
};
