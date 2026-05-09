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
        Schema::table('admissions', function (Blueprint $table) {
            if (!Schema::hasIndex('admissions', 'admissions_type_status_date_index')) {
                $table->index(['admission_type', 'status', 'admission_date']);
            }
        });

        Schema::table('medical_records', function (Blueprint $table) {
            if (!Schema::hasIndex('medical_records', 'medical_records_patient_date_index')) {
                $table->index(['patient_id', 'created_at']);
            }
        });

        Schema::table('vitals_records', function (Blueprint $table) {
            if (!Schema::hasIndex('vitals_records', 'vitals_records_admission_date_index')) {
                $table->index(['admission_id', 'recorded_at']);
            }
        });

        Schema::table('paeds_vitals', function (Blueprint $table) {
            if (!Schema::hasIndex('paeds_vitals', 'paeds_vitals_admission_date_index')) {
                $table->index(['admission_id', 'recorded_at']);
            }
        });

        Schema::table('nicu_vitals', function (Blueprint $table) {
            if (!Schema::hasIndex('nicu_vitals', 'nicu_vitals_admission_date_index')) {
                $table->index(['admission_id', 'recorded_at']);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropIndex(['admission_type', 'status', 'admission_date']);
        });
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropIndex(['patient_id', 'created_at']);
        });
        Schema::table('vitals_records', function (Blueprint $table) {
            $table->dropIndex(['admission_id', 'recorded_at']);
        });
        Schema::table('paeds_vitals', function (Blueprint $table) {
            $table->dropIndex(['admission_id', 'recorded_at']);
        });
        Schema::table('nicu_vitals', function (Blueprint $table) {
            $table->dropIndex(['admission_id', 'recorded_at']);
        });
    }
};
