
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->cascadeOnDelete();

            $table->foreign('client_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('freelancer_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->unique('order_id');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropUnique(['order_id']);
            $table->dropForeign(['freelancer_id']);
            $table->dropForeign(['client_id']);
            $table->dropForeign(['order_id']);
        });
    }
};
