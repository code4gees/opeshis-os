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
        // 1. Expand core 'admissions' table to handle all types
        Schema::table('admissions', function (Blueprint $table) {
            if (!Schema::hasColumn('admissions', 'admission_type')) {
                $table->string('admission_type', 50)->default('general')->after('id');
            }
            if (!Schema::hasColumn('admissions', 'created_at')) {
                $table->timestamps();
            }
            if (!Schema::hasColumn('admissions', 'ward_id')) {
                $table->uuid('ward_id')->nullable()->after('bed_id');
            }
            if (!Schema::hasColumn('admissions', 'diagnosis_at_admission')) {
                $table->text('diagnosis_at_admission')->nullable();
            }
            if (!Schema::hasColumn('admissions', 'admission_date')) {
                $table->timestamp('admission_date')->nullable();
                $table->timestamp('discharge_date')->nullable();
            }
            if (!Schema::hasColumn('admissions', 'admitted_by')) {
                $table->uuid('admitted_by')->nullable()->after('admitting_doctor_id');
            }
            if (!Schema::hasColumn('admissions', 'admission_reason')) {
                $table->text('admission_reason')->nullable()->after('diagnosis_at_admission');
            }
            if (!Schema::hasColumn('admissions', 'discharge_summary')) {
                $table->text('discharge_summary')->nullable()->after('discharge_date');
            }
            if (!Schema::hasColumn('admissions', 'apache_ii_score')) {
                $table->smallInteger('apache_ii_score')->nullable();
                $table->smallInteger('sofa_score')->nullable();
                $table->smallInteger('gcs_score')->nullable();
            }
            if (!Schema::hasColumn('admissions', 'status')) {
                $table->string('status', 20)->default('admitted')->after('id');
            }
            if (!Schema::hasColumn('admissions', 'admission_source')) {
                $table->string('admission_source')->nullable();
                $table->string('discharge_destination')->nullable();
                $table->text('discharge_notes')->nullable();
                $table->uuid('branch_id')->nullable();
            }
        });

        // 2. Data Migration from specialty tables (Forensic Protocol)
        
        // From ward_admissions
        if (Schema::hasTable('ward_admissions')) {
            if (DB::getDriverName() === 'sqlite') {
                DB::statement("
                    INSERT OR IGNORE INTO admissions (
                        id, patient_id, ward_id, bed_id, admitted_by, 
                        admitted_at, discharged_at, admission_reason, discharge_summary, 
                        status, created_at, updated_at, admission_type
                    )
                    SELECT 
                        id, patient_id, ward_id, bed_id, admitted_by, 
                        admitted_at, discharged_at, admitting_diagnosis, discharge_summary, 
                        status, created_at, updated_at, 'general'
                    FROM ward_admissions
                ");
            } else {
                DB::statement("
                    INSERT INTO admissions (
                        id, patient_id, ward_id, bed_id, admitted_by, 
                        admitted_at, discharged_at, admission_reason, discharge_summary, 
                        status, created_at, updated_at, admission_type
                    )
                    SELECT 
                        id, patient_id, ward_id, bed_id, admitted_by, 
                        admitted_at, discharged_at, admitting_diagnosis, discharge_summary, 
                        status, created_at, updated_at, 'general'
                    FROM ward_admissions
                    ON CONFLICT (id) DO NOTHING
                ");
            }
        }

        // From icu_admissions (Note: handle integer IDs by generating UUIDs or keeping if compatible)
        // Since icu_admissions uses integer IDs, we must generate UUIDs if we want to merge them into a UUID table.
        // Or we keep them separate if the risk of ID collision is high.
        // For institutional integrity, I'll use a safer approach: Only merge tables that share the same PK type.
        // Since admissions and ward_admissions are UUID, they are safe to merge.
        // icu_admissions is Integer, so it requires a more complex mapping.
        
        // 3. Decommission Redundant Tables
        // Schema::dropIfExists('ward_admissions'); // Caution: Keep for now until verification
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropColumn([
                'admission_type', 'ward_id', 'admitted_by', 'admission_reason', 
                'discharge_summary', 'apache_ii_score', 'sofa_score', 'gcs_score', 
                'admission_source', 'discharge_destination', 'discharge_notes'
            ]);
        });
    }
};
