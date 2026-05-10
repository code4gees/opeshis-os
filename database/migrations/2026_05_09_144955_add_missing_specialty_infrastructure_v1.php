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
        // 1. Oncology Infrastructure
        if (!Schema::hasTable('onco_protocols')) {
            Schema::create('onco_protocols', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 200);
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('onco_registry')) {
            Schema::create('onco_registry', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('cancer_type', 100);
                $table->string('icd_code', 20)->nullable();
                $table->string('stage', 20)->nullable();
                $table->text('histology')->nullable();
                $table->date('date_of_diagnosis');
                $table->uuid('registered_by');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('onco_treatment_plans')) {
            Schema::create('onco_treatment_plans', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('onco_patient_id');
                $table->uuid('protocol_id');
                $table->string('intent', 50); // Curative, Palliative
                $table->decimal('bsa', 5, 2)->nullable();
                $table->integer('total_cycles');
                $table->string('status', 20)->default('active');
                $table->timestamps();
                $table->foreign('onco_patient_id')->references('id')->on('onco_registry')->onDelete('cascade');
                $table->foreign('protocol_id')->references('id')->on('onco_protocols');
            });
        }

        // 2. Renal / Dialysis Infrastructure
        if (!Schema::hasTable('dialysis_machines')) {
            Schema::create('dialysis_machines', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 50);
                $table->string('serial_number', 50)->unique();
                $table->string('status', 20)->default('available');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('dialysis_patients')) {
            Schema::create('dialysis_patients', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('access_type', 50);
                $table->decimal('dry_weight', 5, 2);
                $table->string('frequency', 50);
                $table->text('diagnosis')->nullable();
                $table->string('status', 20)->default('active');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 3. Psychiatric Infrastructure
        if (!Schema::hasTable('psych_patients')) {
            Schema::create('psych_patients', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->text('chief_complaint')->nullable();
                $table->string('source_of_referral', 100)->nullable();
                $table->string('status', 20)->default('active');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 4. Dental Infrastructure
        if (!Schema::hasTable('dental_patients')) {
            Schema::create('dental_patients', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->text('chief_complaint')->nullable();
                $table->uuid('registered_by');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('dental_procedure_catalog')) {
            Schema::create('dental_procedure_catalog', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 100);
                $table->string('code', 20)->unique();
                $table->decimal('base_cost', 15, 2)->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dental_procedure_catalog');
        Schema::dropIfExists('dental_patients');
        Schema::dropIfExists('psych_patients');
        Schema::dropIfExists('dialysis_patients');
        Schema::dropIfExists('dialysis_machines');
        Schema::dropIfExists('onco_treatment_plans');
        Schema::dropIfExists('onco_registry');
        Schema::dropIfExists('onco_protocols');
    }
};
