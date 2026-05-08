<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->index('medical_id');
        });

        Schema::table('active_queue', function (Blueprint $table) {
            $table->index('patient_id');
            $table->index('status');
        });

        Schema::table('billing_invoices', function (Blueprint $table) {
            $table->index('patient_id');
            $table->index('status');
        });

        Schema::table('inventory', function (Blueprint $table) {
            $table->index('item_name');
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropIndex(['search_hash']);
            $table->dropIndex(['medical_id']);
        });
    }
};
