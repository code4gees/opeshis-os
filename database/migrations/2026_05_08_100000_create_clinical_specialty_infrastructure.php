<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. OPD Infrastructure
        if (!Schema::hasTable('opd_encounters')) {
            Schema::create('opd_encounters', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->uuid('doctor_id')->nullable();
                $table->string('status', 20)->default('active');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('opd_consultations')) {
            Schema::create('opd_consultations', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('encounter_id');
                $table->text('subjective')->nullable();
                $table->text('objective')->nullable();
                $table->text('assessment')->nullable();
                $table->text('plan')->nullable();
                $table->json('icd10_codes')->nullable();
                $table->json('prescriptions_json')->nullable();
                $table->timestamps();
                $table->foreign('encounter_id')->references('id')->on('opd_encounters')->onDelete('cascade');
            });
        }

        // 2. Maternal Health (ANC)
        if (!Schema::hasTable('anc_tracking')) {
            Schema::create('anc_tracking', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->uuid('doctor_id')->nullable();
                $table->date('lmp_date');
                $table->date('edd_date');
                $table->integer('gravida')->default(1);
                $table->integer('parity')->default(0);
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('birth_records')) {
            Schema::create('birth_records', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('mother_id');
                $table->string('baby_name')->nullable();
                $table->string('gender', 10);
                $table->timestamp('birth_datetime');
                $table->decimal('weight_kg', 5, 2);
                $table->string('delivery_type', 50)->default('Normal Vaginal');
                $table->uuid('attending_clinician_id')->nullable();
                $table->timestamps();
                $table->foreign('mother_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 3. Pediatrics (Paeds)
        if (!Schema::hasTable('paeds_admissions')) {
            Schema::create('paeds_admissions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('ward', 50)->nullable();
                $table->string('bed_number', 20)->nullable();
                $table->text('admitting_diagnosis')->nullable();
                $table->decimal('weight_kg', 5, 2)->nullable();
                $table->string('status', 20)->default('active');
                $table->text('discharge_summary')->nullable();
                $table->uuid('admitted_by')->nullable();
                $table->timestamp('admitted_at')->useCurrent();
                $table->timestamp('discharged_at')->nullable();
                $table->uuid('discharged_by')->nullable();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('paeds_vitals')) {
            Schema::create('paeds_vitals', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->decimal('temperature', 4, 1)->nullable();
                $table->integer('heart_rate')->nullable();
                $table->integer('resp_rate')->nullable();
                $table->integer('spo2')->nullable();
                $table->integer('bp_systolic')->nullable();
                $table->integer('bp_diastolic')->nullable();
                $table->uuid('recorded_by')->nullable();
                $table->timestamps();
                $table->foreign('admission_id')->references('id')->on('paeds_admissions')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('paeds_orders')) {
            Schema::create('paeds_orders', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
                $table->string('order_type', 50);
                $table->text('order_text');
                $table->string('priority', 20)->default('normal');
                $table->string('status', 20)->default('pending');
                $table->uuid('ordered_by')->nullable();
                $table->timestamp('acknowledged_at')->nullable();
                $table->uuid('acknowledged_by')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->uuid('completed_by')->nullable();
                $table->text('completion_notes')->nullable();
                $table->timestamps();
                $table->foreign('admission_id')->references('id')->on('paeds_admissions')->onDelete('cascade');
            });
        }

        // 3.5 Institutional Vitals Registry
        if (!Schema::hasTable('vitals_records')) {
            Schema::create('vitals_records', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id')->nullable();
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

        if (!Schema::hasTable('nicu_vitals')) {
            Schema::create('nicu_vitals', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('admission_id');
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

        // 4. Lab Infrastructure
        if (!Schema::hasTable('lab_orders')) {
            Schema::create('lab_orders', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('test_name', 100);
                $table->string('status', 20)->default('pending');
                $table->text('results')->nullable();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 5. Appointments
        if (!Schema::hasTable('appointments')) {
            Schema::create('appointments', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->uuid('doctor_id')->nullable();
                $table->dateTime('appointment_date');
                $table->string('status', 20)->default('scheduled');
                $table->text('notes')->nullable();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 6. Diagnostics Expanded
        if (!Schema::hasTable('radiology_orders')) {
            Schema::create('radiology_orders', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->uuid('doctor_id')->nullable();
                $table->uuid('technician_id')->nullable();
                $table->uuid('radiologist_id')->nullable();
                $table->string('test_name', 100);
                $table->string('status', 20)->default('pending');
                $table->text('indications')->nullable();
                $table->text('findings')->nullable();
                $table->text('impression')->nullable();
                $table->text('results')->nullable();
                $table->string('image_url')->nullable();
                $table->timestamp('ordered_at')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('lab_catalog')) {
            Schema::create('lab_catalog', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 100);
                $table->string('category', 50);
                $table->string('reference_range', 100)->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('lab_order_items')) {
            Schema::create('lab_order_items', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('order_id');
                $table->uuid('test_id');
                $table->string('result_value', 100)->nullable();
                $table->string('flag', 20)->nullable(); // High, Low, Critical
                $table->timestamps();
                $table->foreign('order_id')->references('id')->on('lab_orders')->onDelete('cascade');
                $table->foreign('test_id')->references('id')->on('lab_catalog')->onDelete('cascade');
            });
        }

        // 7. Medical ID Pool
        if (!Schema::hasTable('medical_id_pool')) {
            Schema::create('medical_id_pool', function (Blueprint $table) {
                $table->string('medical_id', 20)->primary();
                $table->string('status', 20)->default('unassigned');
                $table->uuid('patient_id')->nullable();
                $table->timestamp('assigned_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_id_pool');
        Schema::dropIfExists('lab_orders');
        Schema::dropIfExists('paeds_orders');
        Schema::dropIfExists('paeds_vitals');
        Schema::dropIfExists('paeds_admissions');
        Schema::dropIfExists('birth_records');
        Schema::dropIfExists('anc_tracking');
        Schema::dropIfExists('opd_consultations');
        Schema::dropIfExists('opd_encounters');
    }
};
