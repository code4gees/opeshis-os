<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fix lab_order_items
        if (Schema::hasTable('lab_order_items')) {
            Schema::table('lab_order_items', function (Blueprint $table) {
                if (!Schema::hasColumn('lab_order_items', 'created_at')) {
                    $table->timestamps();
                }
            });
        }

        // Unify Audit Log naming
        if (Schema::hasTable('audit_logs') && !Schema::hasTable('sys_audit_log')) {
            // We use sys_audit_log in DashboardController for institutional branding
            Schema::rename('audit_logs', 'sys_audit_log');
        }

        // Ensure sys_audit_log has proper structure if it exists or was renamed
        if (Schema::hasTable('sys_audit_log')) {
            Schema::table('sys_audit_log', function (Blueprint $table) {
                if (!Schema::hasColumn('sys_audit_log', 'created_at')) {
                    $table->timestamps();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('sys_audit_log')) {
            Schema::rename('sys_audit_log', 'audit_logs');
        }
    }
};
