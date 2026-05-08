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
            $table->index(['status', 'created_at']);
        });


        Schema::table('dialysis_sessions', function (Blueprint $table) {
            if (!Schema::hasColumn('dialysis_sessions', 'status')) {
                $table->string('status', 20)->default('in_progress');
            }
            $table->index(['status', 'started_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('active_queue', function (Blueprint $table) {
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::table('billing_invoices', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('dialysis_sessions', function (Blueprint $table) {
            $table->dropIndex(['status', 'started_at']);
        });
    }
};
