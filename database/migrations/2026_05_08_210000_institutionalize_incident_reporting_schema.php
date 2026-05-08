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
        if (!Schema::hasTable('incident_reports')) {
            Schema::create('incident_reports', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('incident_type');
                $table->date('date_of_incident');
                $table->string('location');
                $table->text('description');
                $table->text('immediate_action')->nullable();
                $table->string('severity', 20);
                $table->string('status', 20)->default('reported');
                $table->uuid('reported_by');
                
                // Investigation Fields
                $table->text('root_cause')->nullable();
                $table->text('corrective_action')->nullable();
                $table->uuid('investigated_by')->nullable();
                $table->timestamp('investigated_at')->nullable();
                
                $table->timestamps();
                
                $table->foreign('reported_by')->references('id')->on('users');
                $table->foreign('investigated_by')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_reports');
    }
};
