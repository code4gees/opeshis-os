<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('dhis2_config')) {
            Schema::create('dhis2_config', function (Blueprint $table) {
                $table->id();
                $table->text('instance_url')->nullable();
                $table->text('api_user')->nullable();
                $table->text('api_password')->nullable();
                $table->text('org_unit_id')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('dhis2_reports')) {
            Schema::create('dhis2_reports', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('report_period', 20)->nullable();
                $table->string('report_type', 50)->nullable();
                $table->uuid('generated_by')->nullable();
                $table->jsonb('data_payload')->nullable();
                $table->string('status', 20)->default('DRAFT');
                $table->timestamps();

                $table->foreign('generated_by')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('dhis2_reports');
        Schema::dropIfExists('dhis2_config');
    }
};
