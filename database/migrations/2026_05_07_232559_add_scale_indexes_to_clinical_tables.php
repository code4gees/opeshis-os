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
            if (!Schema::hasColumn('active_queue', 'room_id')) {
                $table->string('room_id', 50)->nullable();
                $table->uuid('assigned_doctor_id')->nullable();
                $table->string('intent', 100)->nullable();
                $table->json('pre_check_data')->nullable();
                $table->json('complaint_data')->nullable();
                $table->json('vitals_data')->nullable();
                $table->boolean('is_nurse_validated')->default(false);
                $table->uuid('branch_id')->nullable();
            }
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
