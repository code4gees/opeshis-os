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
        // 1. Governance & Security Extensions
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'two_factor_code')) {
                $table->string('two_factor_code', 6)->nullable();
                $table->timestamp('two_factor_expires_at')->nullable();
            }
        });

        // 2. Specialty Clinical Registries
        if (!Schema::hasTable('ncd_registry')) {
            Schema::create('ncd_registry', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('condition_type', 100);
                $table->uuid('enrolled_by');
                $table->string('status', 20)->default('active');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
                $table->foreign('enrolled_by')->references('id')->on('users');
            });
        }

        if (!Schema::hasTable('ncd_metrics')) {
            Schema::create('ncd_metrics', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('metric_type', 50);
                $table->decimal('metric_value', 15, 2);
                $table->string('metric_unit', 20);
                $table->uuid('visit_id')->nullable();
                $table->uuid('noted_by');
                $table->timestamp('measured_at')->useCurrent();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
                $table->foreign('noted_by')->references('id')->on('users');
            });
        }

        // 3. Quality & Risk Management
        if (!Schema::hasTable('incidents')) {
            Schema::create('incidents', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('reporter_id');
                $table->string('incident_type', 100);
                $table->string('severity_level', 50);
                $table->text('description');
                $table->string('location', 255)->nullable();
                $table->timestamp('incident_date');
                $table->boolean('is_anonymous')->default(false);
                $table->string('status', 50)->default('reported');
                $table->timestamps();
                $table->foreign('reporter_id')->references('id')->on('users');
            });
        }

        if (!Schema::hasTable('capa_actions')) {
            Schema::create('capa_actions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('incident_id');
                $table->text('corrective_action');
                $table->uuid('assigned_to');
                $table->date('deadline');
                $table->string('status', 50)->default('pending');
                $table->timestamps();
                $table->foreign('incident_id')->references('id')->on('incidents')->onDelete('cascade');
                $table->foreign('assigned_to')->references('id')->on('users');
            });
        }

        // 4. Institutional Support Systems (CSSD)
        if (!Schema::hasTable('cssd_sterilizers')) {
            Schema::create('cssd_sterilizers', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('sterilizer_name', 100);
                $table->string('sterilizer_type', 50);
                $table->boolean('is_active')->default(true);
                $table->date('next_validation_due')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('cssd_sterilization_loads')) {
            Schema::create('cssd_sterilization_loads', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('load_number', 50);
                $table->uuid('sterilizer_id');
                $table->string('sterilization_method', 100);
                $table->string('load_status', 50);
                $table->date('load_date');
                $table->date('expiry_date');
                $table->timestamps();
                $table->foreign('sterilizer_id')->references('id')->on('cssd_sterilizers')->onDelete('cascade');
            });
        }

        // 5. Digital Health Hub
        if (!Schema::hasTable('telemedicine_sessions')) {
            Schema::create('telemedicine_sessions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->uuid('doctor_id');
                $table->timestamp('scheduled_at');
                $table->text('meeting_link')->nullable();
                $table->string('status', 50)->default('scheduled');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
                $table->foreign('doctor_id')->references('id')->on('users');
            });
        }

        // 6. National Health Reporting (DHIS2)
        if (!Schema::hasTable('dhis2_config')) {
            Schema::create('dhis2_config', function (Blueprint $table) {
                $table->id();
                $table->text('instance_url');
                $table->text('api_user');
                $table->text('api_password');
                $table->text('org_unit_id');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('dhis2_reports')) {
            Schema::create('dhis2_reports', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('report_period', 20);
                $table->string('report_type', 50);
                $table->uuid('generated_by');
                $table->json('data_payload')->nullable();
                $table->string('status', 20);
                $table->timestamps();
                $table->foreign('generated_by')->references('id')->on('users');
            });
        }

        // 7. Mortality Surveillance
        if (!Schema::hasTable('mortality_records')) {
            Schema::create('mortality_records', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->text('cause_of_death');
                $table->timestamp('death_datetime');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mortality_records');
        Schema::dropIfExists('dhis2_reports');
        Schema::dropIfExists('dhis2_config');
        Schema::dropIfExists('telemedicine_sessions');
        Schema::dropIfExists('cssd_sterilization_loads');
        Schema::dropIfExists('cssd_sterilizers');
        Schema::dropIfExists('capa_actions');
        Schema::dropIfExists('incidents');
        Schema::dropIfExists('ncd_metrics');
        Schema::dropIfExists('ncd_registry');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['two_factor_code', 'two_factor_expires_at']);
        });
    }
};
