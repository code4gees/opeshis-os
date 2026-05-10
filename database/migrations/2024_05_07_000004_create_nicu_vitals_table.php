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
        if (!Schema::hasTable('nicu_vitals')) {
            Schema::create('nicu_vitals', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id')->index();
                $table->decimal('temperature', 4, 1)->nullable();
                $table->integer('heart_rate')->nullable();
                $table->integer('resp_rate')->nullable();
                $table->integer('spo2')->nullable();
                $table->integer('bp_systolic')->nullable();
                $table->integer('bp_diastolic')->nullable();
                $table->uuid('recorded_by')->nullable();
                $table->timestamp('recorded_at')->useCurrent();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nicu_vitals');
    }
};
