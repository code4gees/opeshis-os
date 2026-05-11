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
            // Data Migration (Safe PHP Protocol)
            DB::table('paeds_admissions')->orderBy('created_at')->chunk(100, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('admissions')->insert([
                        'patient_id' => $row->patient_id,
                        'diagnosis_at_admission' => $row->admission_diagnosis,
                        'admission_date' => $row->admission_time,
                        'discharge_date' => $row->discharge_time,
                        'discharge_summary' => $row->discharge_notes,
                        'status' => $row->status,
                        'admitted_by' => null,
                        'branch_id' => $row->branch_id,
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                        'admission_type' => 'paeds',
                        'specialty_data' => json_encode([
                            'ward_bed_id' => $row->ward_bed_id,
                            'admission_source' => $row->admission_source,
                            'weight_kg' => $row->weight_kg,
                            'height_cm' => $row->height_cm,
                            'muac_cm' => $row->muac_cm,
                            'guardian_name' => $row->guardian_name
                        ])
                    ]);
                }
            });

            // Decommission (Forensic CASCADE)
            if (DB::getDriverName() === 'sqlite') {
                Schema::dropIfExists('paeds_admissions');
            } else {
                Schema::dropIfExists("paeds_admissions");
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
