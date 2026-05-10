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
        // 1. Ophthalmology Infrastructure
        if (!Schema::hasTable('eye_patients')) {
            Schema::create('eye_patients', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('status', 20)->default('active');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 2. ENT Infrastructure
        if (!Schema::hasTable('ent_patients')) {
            Schema::create('ent_patients', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('status', 20)->default('active');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 3. Dermatology Infrastructure
        if (!Schema::hasTable('derm_patients')) {
            Schema::create('derm_patients', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('patient_id');
                $table->string('status', 20)->default('active');
                $table->timestamps();
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            });
        }

        // 4. Asset Management (Fixing InventoryController exists:sys_inventory error)
        if (!Schema::hasTable('sys_inventory')) {
            // Note: Inventory model uses 'inventory' table.
            // We'll create sys_inventory as a synonym/link or just make it match what Controller expects.
            Schema::create('sys_inventory', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('item_name', 100);
                $table->string('category', 50);
                $table->integer('stock_level')->default(0);
                $table->decimal('unit_price', 15, 2);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_inventory');
        Schema::dropIfExists('derm_patients');
        Schema::dropIfExists('ent_patients');
        Schema::dropIfExists('eye_patients');
    }
};
