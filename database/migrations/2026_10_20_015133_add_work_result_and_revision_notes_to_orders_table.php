
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'work_result_file')) {
                $table->string('work_result_file')->nullable();
            }

            if (!Schema::hasColumn('orders', 'revision_notes')) {
                $table->text('revision_notes')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'work_result_file')) {
                $table->dropColumn('work_result_file');
            }

            if (Schema::hasColumn('orders', 'revision_notes')) {
                $table->dropColumn('revision_notes');
            }
        });
    }
};
