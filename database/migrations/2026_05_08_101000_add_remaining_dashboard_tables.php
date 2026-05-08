<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Appointments
        if (!Schema::hasTable('appointments')) {
            Schema::create('appointments', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->uuid('doctor_id')->nullable();
                $table->dateTime('appointment_date');
                $table->string('status', 20)->default('scheduled');
                $table->text('notes')->nullable();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 2. Diagnostics Expanded
        if (!Schema::hasTable('radiology_orders')) {
            Schema::create('radiology_orders', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('test_name', 100);
                $table->string('status', 20)->default('pending');
                $table->text('results')->nullable();
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('lab_catalog')) {
            Schema::create('lab_catalog', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 100);
                $table->string('category', 50);
                $table->string('reference_range', 100)->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('lab_order_items')) {
            Schema::create('lab_order_items', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('order_id');
                $table->uuid('test_id');
                $table->string('result_value', 100)->nullable();
                $table->string('flag', 20)->nullable(); // High, Low, Critical
                $table->timestamps();
                $table->foreign('order_id')->references('id')->on('lab_orders')->onDelete('cascade');
                $table->foreign('test_id')->references('id')->on('lab_catalog')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('sys_radiology_catalog')) {
            Schema::create('sys_radiology_catalog', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 100);
                $table->string('category', 50)->nullable();
                $table->decimal('price', 10, 2)->nullable();
                $table->string('modality', 50)->nullable();
                $table->boolean('requires_contrast')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_order_items');
        Schema::dropIfExists('lab_catalog');
        Schema::dropIfExists('radiology_orders');
        Schema::dropIfExists('appointments');
    }
};
