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
        // 1. Drop the legacy view if it exists
        if (DB::getDriverName() === 'pgsql') {
            \DB::statement('DROP VIEW IF EXISTS sys_settings CASCADE');
        } elseif (DB::getDriverName() === 'sqlite') {
            // SQLite fails if we try to DROP VIEW on a table
            try {
                \DB::statement('DROP VIEW IF EXISTS sys_settings');
            } catch (\Exception $e) {
                // Ignore if it's actually a table
            }
        } else {
            \DB::statement('DROP VIEW IF EXISTS sys_settings');
        }

        // 2. If the real table system_settings exists, rename it to sys_settings
        if (Schema::hasTable('system_settings')) {
            Schema::rename('system_settings', 'sys_settings');
        }

        // 3. Standardize columns in the now-base-table sys_settings
        Schema::table('sys_settings', function (Blueprint $table) {
            if (Schema::hasColumn('sys_settings', 'setting_key')) {
                $table->renameColumn('setting_key', 'key');
            }
            if (Schema::hasColumn('sys_settings', 'setting_value')) {
                $table->renameColumn('setting_value', 'value');
            }
            // Ensure metadata columns exist
            if (!Schema::hasColumn('sys_settings', 'branch_id')) {
                $table->uuid('branch_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Institutional decision: Merging is destructive to the redundant view structure.
    }
};
