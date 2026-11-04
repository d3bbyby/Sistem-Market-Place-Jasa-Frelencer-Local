<?php

use Illuminate\Database\Migrations\Migration;
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
        Schema::table('portfolios', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('project_link')->nullable();
            $table->foreignId('service_id')->nullable()->change();
            $table->string('file_path')->nullable()->change();
            $table->string('caption')->nullable()->change();
        });

        DB::table('portfolios')
            ->join('services', 'portfolios.service_id', '=', 'services.id')
            ->select([
                'portfolios.id',
                'portfolios.caption',
                'portfolios.file_path',
                'services.freelancer_id',
            ])
            ->orderBy('portfolios.id')
            ->chunk(100, function ($portfolios): void {
                foreach ($portfolios as $portfolio) {
                    DB::table('portfolios')
                        ->where('id', $portfolio->id)
                        ->update([
                            'user_id' => $portfolio->freelancer_id,
                            'title' => $portfolio->caption,
                            'image' => $portfolio->file_path,
                        ]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::table('portfolios')->whereNull('service_id')->exists()) {
            throw new RuntimeException('Cannot roll back while portfolios are not linked to a service.');
        }

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'title', 'description', 'image', 'project_link']);
            $table->foreignId('service_id')->nullable(false)->change();
            $table->string('file_path')->nullable(false)->change();
            $table->string('caption')->nullable(false)->change();
        });
    }
};
