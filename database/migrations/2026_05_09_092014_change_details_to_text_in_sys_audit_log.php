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
        if (DB::getDriverName() === 'sqlite') {
            // SQLite does not support ALTER COLUMN directly for type changes.
            // However, it is dynamically typed, so we can ignore this or use a temporary table if needed.
            // For audit logs, we'll keep it as is in SQLite.
            return;
        }
        DB::statement('ALTER TABLE sys_audit_log ALTER COLUMN details TYPE TEXT USING details::text');
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') return;
        DB::statement('ALTER TABLE sys_audit_log ALTER COLUMN details TYPE JSONB USING details::jsonb');
    }
};
