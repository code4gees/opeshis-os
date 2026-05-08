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
        // 1. Wards
        if (!Schema::hasTable('wards')) {
            Schema::create('wards', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('type', 50)->nullable(); // general, maternity, paeds, intensive, etc.
                $table->timestamps();
            });
        }

        // 2. Beds
        if (!Schema::hasTable('ward_beds')) {
            Schema::create('ward_beds', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('ward_id');
                $table->string('bed_number', 20);
                $table->string('status', 20)->default('available'); // available, occupied, maintenance, cleaning
                $table->uuid('patient_id')->nullable();
                $table->timestamp('released_at')->nullable();
                $table->timestamps();
                $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');
            });
        }

        // 3. Admissions
        if (!Schema::hasTable('ward_admissions')) {
            Schema::create('ward_admissions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->uuid('bed_id');
                $table->uuid('ward_id');
                $table->text('admitting_diagnosis');
                $table->string('consultant')->nullable();
                $table->string('status', 20)->default('active'); // active, discharged, transferred
                $table->uuid('admitted_by');
                $table->timestamp('admitted_at');
                $table->text('discharge_diagnosis')->nullable();
                $table->text('discharge_summary')->nullable();
                $table->timestamp('discharged_at')->nullable();
                $table->uuid('discharged_by')->nullable();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
                $table->foreign('bed_id')->references('id')->on('ward_beds')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ward_admissions');
        Schema::dropIfExists('ward_beds');
        Schema::dropIfExists('wards');
    }
};
