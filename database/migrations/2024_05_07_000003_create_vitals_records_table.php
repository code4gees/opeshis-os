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
        if (!Schema::hasTable('vitals_records')) {
            Schema::create('vitals_records', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id')->index();
                $table->uuid('round_id')->nullable()->index();
                $table->decimal('temp', 4, 1)->nullable();
                $table->integer('pulse')->nullable();
                $table->integer('respiratory_rate')->nullable();
                $table->integer('bp_sys')->nullable();
                $table->integer('bp_dia')->nullable();
                $table->integer('spo2')->nullable();
                $table->integer('news2_score')->default(0);
                $table->string('risk_level', 20)->default('low');
                $table->uuid('recorded_by')->nullable();
                $table->timestamp('recorded_at')->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vitals_records');
    }
};
