<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Convert OPD to UUID
        // Note: Empty tables allowed for clean drop/recreate
        Schema::dropIfExists('opd_consultations');
        Schema::dropIfExists('opd_discharge_summaries');
        Schema::dropIfExists('opd_procedure_queue');
        Schema::dropIfExists('opd_encounters');

        Schema::create('opd_encounters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->string('encounter_number', 32)->unique();
            $table->timestamp('check_in_time')->useCurrent();
            $table->uuid('assigned_doctor_id')->nullable();
            $table->string('triage_category', 20)->nullable();
            $table->string('status', 20)->default('waiting');
            $table->uuid('branch_id')->nullable();
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });

        Schema::create('opd_consultations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('encounter_id');
            $table->text('subjective')->nullable();
            $table->text('objective')->nullable();
            $table->text('assessment')->nullable();
            $table->text('plan')->nullable();
            $table->json('icd10_codes')->nullable();
            $table->json('prescriptions_json')->nullable();
            $table->text('procedure_notes')->nullable();
            $table->boolean('finalized')->default(false);
            $table->uuid('branch_id')->nullable();
            $table->timestamps();
            $table->foreign('encounter_id')->references('id')->on('opd_encounters')->onDelete('cascade');
        });

        Schema::create('opd_discharge_summaries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('encounter_id');
            $table->text('summary')->nullable();
            $table->text('recommendations')->nullable();
            $table->timestamps();
            $table->foreign('encounter_id')->references('id')->on('opd_encounters')->onDelete('cascade');
        });

        Schema::create('opd_procedure_queue', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('encounter_id');
            $table->string('procedure_name');
            $table->timestamp('scheduled_time')->useCurrent();
            $table->string('status', 20)->default('pending');
            $table->uuid('branch_id')->nullable();
            $table->timestamps();
            $table->foreign('encounter_id')->references('id')->on('opd_encounters')->onDelete('cascade');
        });

        // 2. Finalize Admissions Consolidation (Hybrid Specialty Architecture)
        Schema::table('admissions', function (Blueprint $table) {
            if (!Schema::hasColumn('admissions', 'specialty_data')) {
                $table->json('specialty_data')->nullable()->after('admission_type');
            }
            if (!Schema::hasColumn('admissions', 'outcome')) {
                $table->string('outcome', 50)->nullable();
            }
        });

        // Decommission specialty admission tables (Forensic CASCADE)
        if (DB::getDriverName() === 'sqlite') {
            DB::statement("DROP TABLE IF EXISTS icu_admissions");
            DB::statement("DROP TABLE IF EXISTS obstetrics_admissions");
            DB::statement("DROP TABLE IF EXISTS ward_admissions");
        } else {
            DB::statement("DROP TABLE IF EXISTS icu_admissions");
            DB::statement("DROP TABLE IF EXISTS obstetrics_admissions");
            DB::statement("DROP TABLE IF EXISTS ward_admissions");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // High complexity rollback not implemented for this master consolidation
    }
};
