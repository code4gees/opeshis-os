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
        // Active Queue Performance
        Schema::table('active_queue', function (Blueprint $table) {
            if (!Schema::hasIndex('active_queue', 'active_queue_created_at_index')) {
                $table->index('created_at');
            }
        });

        // Lab & Radiology Performance
        Schema::table('lab_orders', function (Blueprint $table) {
            if (!Schema::hasIndex('lab_orders', 'lab_orders_status_index')) {
                $table->index('status');
            }
        });
        Schema::table('radiology_orders', function (Blueprint $table) {
            if (!Schema::hasIndex('radiology_orders', 'radiology_orders_status_index')) {
                $table->index('status');
            }
        });

        // Financial & Billing Analytics Performance
        Schema::table('billing_invoices', function (Blueprint $table) {
            if (!Schema::hasIndex('billing_invoices', 'billing_invoices_status_updated_at_index')) {
                $table->index(['status', 'updated_at']);
            }
        });

        // Ward/Admissions Performance
        Schema::table('admissions', function (Blueprint $table) {
            if (!Schema::hasIndex('admissions', 'admissions_status_index')) {
                $table->index('status');
            }
            if (!Schema::hasIndex('admissions', 'admissions_admitting_doctor_id_index')) {
                $table->index('admitting_doctor_id');
            }
        });

        // Appointments Performance
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasIndex('appointments', 'appointments_doctor_id_appointment_date_status_index')) {
                $table->index(['doctor_id', 'appointment_date', 'status']);
            }
        });

        // Patient Growth Chart Performance
        Schema::table('patients', function (Blueprint $table) {
            if (!Schema::hasIndex('patients', 'patients_created_at_index')) {
                $table->index('created_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('active_queue', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('lab_orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });
        Schema::table('radiology_orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('billing_invoices', function (Blueprint $table) {
            $table->dropIndex(['status', 'updated_at']);
        });

        Schema::table('admissions', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['admitting_doctor_id']);
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex(['doctor_id', 'appointment_date', 'status']);
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });
    }
};
