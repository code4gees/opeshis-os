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
        if (Schema::hasTable('paeds_admissions')) {
            if (DB::getDriverName() !== 'sqlite') {
                // Data Migration (Forensic Protocol)
                DB::statement("
                    INSERT INTO admissions (
                        patient_id, diagnosis_at_admission, admission_date, discharge_date, 
                        discharge_summary, status, admitted_by, branch_id, created_at, updated_at, 
                        admission_type, specialty_data
                    )
                    SELECT 
                        patient_id, admission_diagnosis, admission_time, discharge_time, 
                        discharge_notes, status, NULL, branch_id, created_at, updated_at, 
                        'paeds', 
                        json_build_object(
                            'ward_bed_id', ward_bed_id,
                            'admission_source', admission_source,
                            'weight_kg', weight_kg,
                            'height_cm', height_cm,
                            'muac_cm', muac_cm,
                            'guardian_name', guardian_name
                        )
                    FROM paeds_admissions
                ");

                // Decommission (Forensic CASCADE)
                DB::statement("DROP TABLE IF EXISTS paeds_admissions CASCADE");
            } else {
                Schema::dropIfExists('paeds_admissions');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback not implemented for this normalization
    }
};
