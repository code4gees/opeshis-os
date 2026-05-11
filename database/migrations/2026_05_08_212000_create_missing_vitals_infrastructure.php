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
                $table->uuid('admission_id');
                $table->uuid('round_id')->nullable();
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

        if (!Schema::hasTable('nursing_rounds')) {
            Schema::create('nursing_rounds', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->uuid('staff_id');
                $table->timestamp('scheduled_at')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->string('task_type', 100)->nullable();
                $table->string('status', 20)->default('pending');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('hdu_vitals_log')) {
            Schema::create('hdu_vitals_log', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->decimal('temp', 4, 1)->nullable();
                $table->integer('pulse')->nullable();
                $table->integer('bp_sys')->nullable();
                $table->integer('bp_dia')->nullable();
                $table->integer('spo2')->nullable();
                $table->uuid('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('nicu_vitals')) {
            Schema::create('nicu_vitals', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->decimal('temperature', 4, 1)->nullable();
                $table->integer('heart_rate')->nullable();
                $table->integer('resp_rate')->nullable();
                $table->integer('spo2')->nullable();
                $table->uuid('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('sys_settings')) {
            Schema::create('sys_settings', function (Blueprint $table) {
                $table->string('key')->primary();
                $table->text('value')->nullable();
                $table->uuid('branch_id')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('icu_vitals')) {
            Schema::create('icu_vitals', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->integer('bp_systolic')->nullable();
                $table->integer('bp_diastolic')->nullable();
                $table->integer('heart_rate')->nullable();
                $table->decimal('spo2', 5, 2)->nullable();
                $table->decimal('temperature', 5, 2)->nullable();
                $table->uuid('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('icu_sofa_scores')) {
            Schema::create('icu_sofa_scores', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->integer('respiratory_score')->default(0);
                $table->integer('coagulation_score')->default(0);
                $table->integer('liver_score')->default(0);
                $table->integer('cardiovascular_score')->default(0);
                $table->integer('cns_score')->default(0);
                $table->integer('renal_score')->default(0);
                $table->integer('total_score')->default(0);
                $table->uuid('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('obstetrics_observations')) {
            Schema::create('obstetrics_observations', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->decimal('dilation_cm', 4, 1)->nullable();
                $table->integer('fetal_heart_rate')->nullable();
                $table->string('contraction_intensity', 20)->nullable();
                $table->text('notes')->nullable();
                $table->uuid('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('obstetrics_deliveries')) {
            Schema::create('obstetrics_deliveries', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->timestamp('delivery_datetime');
                $table->string('outcome', 50);
                $table->decimal('birth_weight', 5, 3)->nullable();
                $table->string('gender', 10)->nullable();
                $table->integer('apgar_1m')->nullable();
                $table->integer('apgar_5m')->nullable();
                $table->uuid('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('paeds_growth_records')) {
            Schema::create('paeds_growth_records', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->decimal('weight_kg', 5, 2)->nullable();
                $table->decimal('height_cm', 5, 2)->nullable();
                $table->decimal('muac_cm', 4, 1)->nullable();
                $table->decimal('head_circ_cm', 4, 1)->nullable();
                $table->uuid('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('nicu_feeding_log')) {
            Schema::create('nicu_feeding_log', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->string('feeding_type', 50);
                $table->decimal('volume_ml', 6, 2);
                $table->text('notes')->nullable();
                $table->uuid('recorded_by')->nullable();
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
        Schema::dropIfExists('hdu_vitals_log');
        Schema::dropIfExists('nursing_rounds');
        Schema::dropIfExists('vitals_records');
    }
};
