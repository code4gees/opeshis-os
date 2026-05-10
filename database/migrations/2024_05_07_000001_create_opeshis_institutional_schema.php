<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Governance & Security
        Schema::create('sys_roles', function (Blueprint $table) {
            $table->string('name', 50)->primary();
            $table->text('description')->nullable();
        });

        Schema::create('sys_permissions', function (Blueprint $table) {
            $table->string('code', 100)->primary();
            $table->string('name', 100);
            $table->string('category', 50);
            $table->text('description')->nullable();
        });

        Schema::create('sys_role_permissions', function (Blueprint $table) {
            $table->string('role_name', 50);
            $table->string('permission_code', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->primary(['role_name', 'permission_code']);
            $table->foreign('role_name')->references('name')->on('sys_roles')->onDelete('cascade');
            $table->foreign('permission_code')->references('code')->on('sys_permissions')->onDelete('cascade');
        });

        // 2. Clinical Core
        Schema::create('patients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('medical_id', 20)->unique();
            $table->text('full_name');
            $table->string('phone', 20)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password_hash')->nullable();
            $table->string('gender', 10);
            $table->date('dob');
            $table->string('blood_group', 10)->nullable();
            $table->string('genotype', 10)->nullable();
            $table->text('allergies')->nullable();
            $table->text('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->uuid('insurance_provider_id')->nullable();
            $table->string('insurance_policy_number')->nullable();
            $table->uuid('branch_id')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('search_hash')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('active_queue', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->string('status', 20)->default('waiting');
            $table->string('priority', 20)->default('normal');
            $table->json('vitals_data')->nullable();
            $table->json('complaint_data')->nullable();
            $table->string('intent', 50)->nullable();
            $table->boolean('is_nurse_validated')->default(false);
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });

        Schema::create('medical_records', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->uuid('doctor_id');
            $table->text('subjective')->nullable();
            $table->text('objective')->nullable();
            $table->text('assessment')->nullable();
            $table->text('plan')->nullable();
            $table->text('provisional_diagnosis')->nullable();
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });

        // 3. Diagnostics & Support
        Schema::create('inventory', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('item_name', 100);
            $table->string('category', 50);
            $table->integer('stock_level')->default(0);
            $table->decimal('unit_price', 15, 2);
            $table->timestamps();
        });

        Schema::create('prescriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->uuid('inventory_id');
            $table->string('dosage', 100);
            $table->integer('quantity');
            $table->string('status', 20)->default('pending');
            $table->timestamp('dispensed_at')->nullable();
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventory')->onDelete('cascade');
        });

        // 4. Intelligence & Forensics
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string('action', 100);
            $table->string('table_name', 50);
            $table->uuid('record_id')->nullable();
            $table->text('details')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('sys_medical_terms', function (Blueprint $table) {
            $table->string('code', 50)->primary();
            $table->text('term_name');
            $table->string('category', 50);
        });

        Schema::create('sys_drug_interactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('drug_a_id');
            $table->uuid('drug_b_id');
            $table->string('severity', 20);
            $table->text('description')->nullable();
        });

        // 5. Admissions & Wards
        Schema::create('sys_wards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('category', 50);
            $table->integer('capacity');
        });

        Schema::create('sys_beds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ward_id');
            $table->string('bed_number', 20);
            $table->string('status', 20)->default('available');
            $table->foreign('ward_id')->references('id')->on('sys_wards')->onDelete('cascade');
        });

        Schema::create('admissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->uuid('bed_id')->nullable();
            $table->timestamp('admitted_at')->useCurrent();
            $table->timestamp('discharged_at')->nullable();
            $table->text('clinical_notes')->nullable();
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('bed_id')->references('id')->on('sys_beds')->onDelete('cascade');
        });

        // 6. Billing & Finance
        Schema::create('insurance_providers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('code', 20)->unique();
            $table->integer('default_co_pay_rate')->default(0);
            $table->timestamps();
        });

        Schema::create('billing_invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invoice_number', 50)->unique();
            $table->uuid('patient_id');
            $table->uuid('provider_id')->nullable();
            $table->decimal('total_amount', 15, 2);
            $table->decimal('patient_due_amount', 15, 2);
            $table->decimal('insurance_due_amount', 15, 2)->default(0);
            $table->string('status', 20)->default('pending');
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('insurance_providers')->onDelete('set null');
        });

        Schema::create('billing_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('invoice_id');
            $table->string('item_type', 50); // Radiology, Lab, Pharmacy, Consultation, etc.
            $table->string('item_name', 100);
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('billing_invoices')->onDelete('cascade');
        });

        // Niche Clinical: Dialysis
        Schema::create('dialysis_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->string('machine_id', 50);
            $table->decimal('dry_weight', 5, 2);
            $table->timestamp('started_at');
            $table->timestamp('completed_at')->nullable();
            $table->text('outcome_notes')->nullable();
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });

        // Niche Clinical: Physiotherapy
        Schema::create('physio_cases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->text('initial_assessment');
            $table->string('status', 20)->default('active');
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });

        // Blood Bank
        Schema::create('sys_blood_bank', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('blood_group', 5);
            $table->integer('units_available')->default(0);
            $table->date('last_update');
            $table->timestamps();
        });

        // Human Resources: Certifications
        Schema::create('sys_certifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('title', 100);
            $table->string('issuing_body', 100);
            $table->date('expiry_date')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sys_certifications');
        Schema::dropIfExists('sys_blood_bank');
        Schema::dropIfExists('physio_cases');
        Schema::dropIfExists('dialysis_sessions');
        Schema::dropIfExists('billing_invoices');
        Schema::dropIfExists('insurance_providers');
        Schema::dropIfExists('admissions');
        Schema::dropIfExists('sys_beds');
        Schema::dropIfExists('sys_wards');
        Schema::dropIfExists('sys_drug_interactions');
        Schema::dropIfExists('sys_medical_terms');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('prescriptions');
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('medical_records');
        Schema::dropIfExists('active_queue');
        Schema::dropIfExists('patients');
        Schema::dropIfExists('sys_role_permissions');
        Schema::dropIfExists('sys_permissions');
        Schema::dropIfExists('sys_roles');
    }
};
