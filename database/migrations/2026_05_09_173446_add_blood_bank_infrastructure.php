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
        // 1. Blood Bank Inventory
        if (!Schema::hasTable('blood_bank_inventory')) {
            Schema::create('blood_bank_inventory', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('blood_group', 10);
                $table->string('status', 20)->default('available');
                $table->timestamps();
            });
        }

        // 2. Blood Transfusions
        if (!Schema::hasTable('blood_transfusions')) {
            Schema::create('blood_transfusions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('blood_group', 10);
                $table->integer('units');
                $table->string('status', 20)->default('completed');
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
        Schema::dropIfExists('blood_transfusions');
        Schema::dropIfExists('blood_bank_inventory');
    }
};
