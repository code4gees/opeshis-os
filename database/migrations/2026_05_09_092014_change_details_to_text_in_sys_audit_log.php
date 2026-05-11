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
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE sys_audit_log ALTER COLUMN details TYPE TEXT USING details::text');
        } else {
            Schema::table('sys_audit_log', function (Blueprint $table) {
                $table->text('details')->change();
            });
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE sys_audit_log ALTER COLUMN details TYPE JSONB USING details::json');
        } else {
            Schema::table('sys_audit_log', function (Blueprint $table) {
                $table->json('details')->change();
            });
        }
    }
};
