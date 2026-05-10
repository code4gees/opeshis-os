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
        Schema::table('active_queue', function (Blueprint $table) {
            if (!Schema::hasColumn('active_queue', 'vitals_data')) {
                $table->json('vitals_data')->nullable();
            }
            if (!Schema::hasColumn('active_queue', 'complaint_data')) {
                $table->json('complaint_data')->nullable();
            }
            if (!Schema::hasColumn('active_queue', 'intent')) {
                $table->string('intent', 50)->nullable();
            }
            if (!Schema::hasColumn('active_queue', 'is_nurse_validated')) {
                $table->boolean('is_nurse_validated')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('active_queue', function (Blueprint $table) {
            $table->dropColumn(['vitals_data', 'complaint_data', 'intent', 'is_nurse_validated']);
        });
    }
};
