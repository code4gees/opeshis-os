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
        // 1. Surgical Cases / Schedule
        if (!Schema::hasTable('theatre_cases')) {
            Schema::create('theatre_cases', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('procedure_name');
                $table->uuid('surgeon_id')->nullable();
                $table->uuid('anaesthetist_id')->nullable();
                $table->timestamp('scheduled_date');
                $table->string('status', 20)->default('scheduled'); // scheduled, in_progress, recovery, completed, cancelled
                
                // Pre-op Assessment
                $table->boolean('preop_done')->default(false);
                $table->uuid('preop_by')->nullable();
                $table->timestamp('preop_at')->nullable();
                $table->string('asa_grade', 10)->nullable();
                $table->text('airway_assessment')->nullable();
                $table->string('fasting_status', 50)->nullable();
                $table->text('preop_notes')->nullable();
                
                // WHO Checklist
                $table->json('checklist')->nullable();
                $table->uuid('checklist_verified_by')->nullable();
                $table->timestamp('checklist_at')->nullable();
                
                $table->timestamp('started_at')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();
                
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 2. Intra-operative Records
        if (!Schema::hasTable('theatre_intraop')) {
            Schema::create('theatre_intraop', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('case_id');
                $table->string('anaesthesia_type');
                $table->uuid('surgeon_id');
                $table->uuid('anaesthetist_id');
                $table->timestamp('incision_time')->nullable();
                $table->timestamp('closure_time')->nullable();
                $table->text('operative_findings')->nullable();
                $table->integer('estimated_blood_loss')->nullable();
                $table->text('specimens_sent')->nullable();
                $table->string('status', 20)->default('in_progress');
                $table->uuid('completed_by')->nullable();
                $table->timestamps();
                $table->foreign('case_id')->references('id')->on('theatre_cases')->onDelete('cascade');
            });
        }

        // 3. Intra-operative Vitals
        if (!Schema::hasTable('theatre_vitals')) {
            Schema::create('theatre_vitals', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('case_id');
                $table->integer('bp_systolic')->nullable();
                $table->integer('bp_diastolic')->nullable();
                $table->integer('heart_rate')->nullable();
                $table->decimal('spo2', 5, 2)->nullable();
                $table->decimal('etco2', 5, 2)->nullable();
                $table->decimal('temperature', 4, 2)->nullable();
                $table->uuid('recorded_by');
                $table->timestamps();
                $table->foreign('case_id')->references('id')->on('theatre_cases')->onDelete('cascade');
            });
        }

        // 4. Anaesthesia Drugs
        if (!Schema::hasTable('theatre_anaesthesia_drugs')) {
            Schema::create('theatre_anaesthesia_drugs', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('case_id');
                $table->string('drug_name');
                $table->string('dose');
                $table->string('route');
                $table->timestamp('administered_at');
                $table->uuid('administered_by');
                $table->timestamps();
                $table->foreign('case_id')->references('id')->on('theatre_cases')->onDelete('cascade');
            });
        }

        // 5. Recovery Room Records
        if (!Schema::hasTable('theatre_recovery')) {
            Schema::create('theatre_recovery', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('case_id');
                $table->timestamp('arrival_time');
                $table->timestamp('discharge_time')->nullable();
                $table->integer('aldrete_score')->nullable();
                $table->integer('pain_score')->nullable();
                $table->boolean('nausea')->default(false);
                $table->string('current_status')->nullable();
                $table->text('notes')->nullable();
                $table->uuid('recorded_by');
                $table->uuid('updated_by')->nullable();
                $table->timestamps();
                $table->foreign('case_id')->references('id')->on('theatre_cases')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theatre_recovery');
        Schema::dropIfExists('theatre_anaesthesia_drugs');
        Schema::dropIfExists('theatre_vitals');
        Schema::dropIfExists('theatre_intraop');
        Schema::dropIfExists('theatre_cases');
    }
};
