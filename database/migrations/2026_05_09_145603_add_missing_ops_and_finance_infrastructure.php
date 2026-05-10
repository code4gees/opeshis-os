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
        // 1. Asset Register Infrastructure
        if (!Schema::hasTable('sys_assets')) {
            Schema::create('sys_assets', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('asset_name', 100);
                $table->string('asset_tag', 50)->unique();
                $table->string('status', 20)->default('operational');
                $table->date('next_maintenance_date')->nullable();
                $table->timestamps();
            });
        }

        // 2. E-Claims Infrastructure
        if (!Schema::hasTable('e_claims')) {
            Schema::create('e_claims', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('claim_number', 50)->unique();
                $table->uuid('patient_id');
                $table->uuid('provider_id');
                $table->decimal('total_amount', 15, 2);
                $table->string('status', 20)->default('submitted');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
                $table->foreign('provider_id')->references('id')->on('insurance_providers');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_claims');
        Schema::dropIfExists('sys_assets');
    }
};
