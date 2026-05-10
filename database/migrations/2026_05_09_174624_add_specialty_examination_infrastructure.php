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
        // 1. Eye Examinations
        if (!Schema::hasTable('eye_examinations')) {
            Schema::create('eye_examinations', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('eye_patient_id');
                $table->string('va_right', 50)->nullable();
                $table->string('va_left', 50)->nullable();
                $table->decimal('iop_right', 5, 2)->nullable();
                $table->decimal('iop_left', 5, 2)->nullable();
                $table->text('diagnosis');
                $table->text('plan')->nullable();
                $table->uuid('recorded_by');
                $table->timestamps();
                $table->foreign('eye_patient_id')->references('id')->on('eye_patients')->onDelete('cascade');
            });
        }

        // 2. ENT Examinations
        if (!Schema::hasTable('ent_examinations')) {
            Schema::create('ent_examinations', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('ent_patient_id');
                $table->text('ear_findings')->nullable();
                $table->text('nose_findings')->nullable();
                $table->text('throat_findings')->nullable();
                $table->text('diagnosis');
                $table->text('plan')->nullable();
                $table->uuid('recorded_by');
                $table->timestamps();
                $table->foreign('ent_patient_id')->references('id')->on('ent_patients')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ent_examinations');
        Schema::dropIfExists('eye_examinations');
    }
};
