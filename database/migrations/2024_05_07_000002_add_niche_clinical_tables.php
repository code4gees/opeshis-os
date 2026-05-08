<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Niche Clinical: Dialysis
        if (!Schema::hasTable('dialysis_sessions')) {
            Schema::create('dialysis_sessions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('machine_id', 50);
                $table->decimal('dry_weight', 5, 2);
                $table->timestamp('started_at');
                $table->timestamp('completed_at')->nullable();
                $table->text('outcome_notes')->nullable();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // Niche Clinical: Physiotherapy
        if (!Schema::hasTable('physio_cases')) {
            Schema::create('physio_cases', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->text('initial_assessment');
                $table->string('status', 20)->default('active');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // Blood Bank
        if (!Schema::hasTable('sys_blood_bank')) {
            Schema::create('sys_blood_bank', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('blood_group', 5);
                $table->integer('units_available')->default(0);
                $table->date('last_update');
                $table->timestamps();
            });
        }

        // Human Resources: Certifications
        if (!Schema::hasTable('sys_certifications')) {
            Schema::create('sys_certifications', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('user_id');
                $table->string('title', 100);
                $table->string('issuing_body', 100);
                $table->date('expiry_date')->nullable();
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sys_certifications');
        Schema::dropIfExists('sys_blood_bank');
        Schema::dropIfExists('physio_cases');
        Schema::dropIfExists('dialysis_sessions');
    }
};
