<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('orders')) {
            $this->createOrdersTable();

            return;
        }

        try {
            DB::table('orders')->limit(0)->get();

            return;
        } catch (QueryException $exception) {
            if (($exception->errorInfo[1] ?? null) !== 1932) {
                throw $exception;
            }
        }

        DB::statement('DROP TABLE IF EXISTS `orders`');

        $this->createOrdersTable();
    }

    private function createOrdersTable(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('service_id')->constrained('services')->restrictOnDelete();
            $table->decimal('total_price', 12, 2)->nullable();
            $table->enum('status', ['MENUNGGU', 'DIPROSES', 'SUBMITTED', 'REVISI', 'SELESAI'])
                ->default('MENUNGGU');
            $table->string('work_result_file')->nullable();
            $table->text('revision_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep the repaired table and newly created orders when rolling back.
    }
};
