<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add Search Hash to Patients
        if (!Schema::hasColumn('patients', 'search_hash')) {
            Schema::table('patients', function (Blueprint $table) {
                $table->string('search_hash')->nullable()->index();
            });
        }

        // Create Audit Logs Table
        if (!Schema::hasTable('audit_logs')) {
            Schema::create('audit_logs', function (Blueprint $table) {
                $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string('action');
            $table->string('module');
            $table->string('resource_id')->nullable();
            $table->json('payload')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('search_hash');
        });
        Schema::dropIfExists('audit_logs');
    }
};
