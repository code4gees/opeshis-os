<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Specialty & Specialty Units
        if (!Schema::hasTable('specialty_records')) {
            Schema::create('specialty_records', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('clinic_type', 50);
                $table->text('clinical_findings');
                $table->text('procedure_done')->nullable();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('art_records')) {
            Schema::create('art_records', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->decimal('cd4_count', 8, 2)->nullable();
                $table->string('viral_load', 50)->nullable();
                $table->string('regimen', 100)->nullable();
                $table->text('clinical_notes')->nullable();
                $table->timestamps();
            });
        }

        // 2. ICU / HDU / NICU
        $criticalTables = [
            'icu_admissions' => ['bed_number'=>'string:10','admitting_diagnosis'=>'text','status'=>'string:20','admitted_by'=>'uuid','admitted_at'=>'timestamp'],
            'icu_vitals_log'  => ['admission_id'=>'uuid','bp_systolic'=>'integer','bp_diastolic'=>'integer','heart_rate'=>'integer','spo2'=>'decimal:5,2','temperature'=>'decimal:5,2','recorded_by'=>'uuid'],
            'hdu_admissions'  => ['patient_id'=>'uuid','bed_number'=>'string:10','status'=>'string:20','admitted_at'=>'timestamp'],
            'nicu_admissions' => ['patient_id'=>'uuid','mother_patient_id'=>'uuid','birth_weight'=>'decimal:5,3','gestational_age'=>'integer','admitting_diagnosis'=>'text','admitted_by'=>'uuid','status'=>'string:20','admitted_at'=>'timestamp'],
        ];

        foreach ($criticalTables as $tbl => $cols) {
            if (!Schema::hasTable($tbl)) {
                Schema::create($tbl, function (Blueprint $table) use ($cols) {
                    $table->uuid('id')->primary();
                    foreach ($cols as $col => $type) {
                        if ($type === 'uuid') $table->uuid($col);
                        elseif ($type === 'text') $table->text($col)->nullable();
                        elseif ($type === 'integer') $table->integer($col)->nullable();
                        elseif (str_starts_with($type, 'decimal')) $table->decimal($col, 8, 2)->nullable();
                        elseif (str_starts_with($type, 'string:')) $table->string($col, (int)explode(':', $type)[1])->nullable();
                        elseif ($type === 'timestamp') $table->timestamp($col)->nullable();
                    }
                    $table->timestamps();
                });
            }
        }

        // 3. Obstetrics & Family Planning
        if (!Schema::hasTable('obstetrics_admissions')) {
            Schema::create('obstetrics_admissions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->integer('gravida');
                $table->integer('parity');
                $table->integer('gestational_age_weeks');
                $table->string('status', 20)->default('admitted');
                $table->timestamp('admitted_at');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('fp_clients')) {
            Schema::create('fp_clients', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->timestamps();
            });
        }

        // 4. Logistics & Operations
        if (!Schema::hasTable('logistics_logs')) {
            Schema::create('logistics_logs', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('module_type', 50);
                $table->text('event_description');
                $table->string('status', 20)->default('completed');
                $table->uuid('recorded_by')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('laundry_cycles')) {
            Schema::create('laundry_cycles', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('machine_id', 30);
                $table->string('load_type', 30);
                $table->string('status', 20)->default('running');
                $table->timestamp('started_at');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('fleet_vehicles')) {
            Schema::create('fleet_vehicles', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('registration', 20)->unique();
                $table->string('make_model', 100);
                $table->string('status', 20)->default('available');
                $table->timestamps();
            });
        }

        // 5. Mortuary & Blood Bank
        if (!Schema::hasTable('mortuary_slots')) {
            Schema::create('mortuary_slots', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('slot_number', 20)->unique();
                $table->string('status', 20)->default('Vacant');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('mortuary_admissions')) {
            Schema::create('mortuary_admissions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('deceased_name', 200);
                $table->uuid('slot_id');
                $table->timestamp('date_of_admission');
                $table->string('status', 20)->default('admitted');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('blood_bank_donors')) {
            Schema::create('blood_bank_donors', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('full_name', 200);
                $table->string('blood_group', 10);
                $table->timestamps();
            });
        }

        // 6. Admin & HR
        if (!Schema::hasTable('sys_branches')) {
            Schema::create('sys_branches', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 100);
                $table->string('location', 100)->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('staff_credentials')) {
            Schema::create('staff_credentials', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('user_id');
                $table->string('credential_type', 50);
                $table->string('credential_number', 100);
                $table->date('expires_at')->nullable();
                $table->timestamps();
            });
        }

        // 7. Finance & Interop
        if (!Schema::hasTable('payment_providers')) {
            Schema::create('payment_providers', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('display_name', 100);
                $table->string('provider_code', 50)->unique();
                $table->json('config');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('payment_transactions')) {
            Schema::create('payment_transactions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('reference', 100)->unique();
                $table->uuid('patient_id');
                $table->decimal('amount', 15, 2);
                $table->string('status', 20)->default('pending');
                $table->timestamps();
            });
        }

        // 8. Messaging & API
        if (!Schema::hasTable('messaging_providers')) {
            Schema::create('messaging_providers', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('display_name', 100);
                $table->string('status', 20)->default('active');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('api_clients')) {
            Schema::create('api_clients', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 100);
                $table->text('api_key_hash');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('api_clients');
        Schema::dropIfExists('messaging_providers');
        Schema::dropIfExists('payment_transactions');
        Schema::dropIfExists('payment_providers');
        Schema::dropIfExists('staff_credentials');
        Schema::dropIfExists('sys_branches');
        Schema::dropIfExists('blood_bank_donors');
        Schema::dropIfExists('mortuary_admissions');
        Schema::dropIfExists('mortuary_slots');
        Schema::dropIfExists('fleet_vehicles');
        Schema::dropIfExists('laundry_cycles');
        Schema::dropIfExists('logistics_logs');
        Schema::dropIfExists('fp_clients');
        Schema::dropIfExists('obstetrics_admissions');
        Schema::dropIfExists('nicu_admissions');
        Schema::dropIfExists('hdu_admissions');
        Schema::dropIfExists('icu_vitals_log');
        Schema::dropIfExists('icu_admissions');
        Schema::dropIfExists('art_records');
        Schema::dropIfExists('specialty_records');
    }
};
