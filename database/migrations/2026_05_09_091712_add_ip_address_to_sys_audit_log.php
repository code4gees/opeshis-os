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
        Schema::table('sys_audit_log', function (Blueprint $table) {
            if (!Schema::hasColumn('sys_audit_log', 'ip_address')) {
                $table->string('ip_address', 45)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('sys_audit_log', function (Blueprint $table) {
            $table->dropColumn('ip_address');
        });
    }
};
