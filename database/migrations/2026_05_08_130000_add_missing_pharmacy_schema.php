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
        // 1. Drug Formulary
        if (!Schema::hasTable('sys_drug_formulary')) {
            Schema::create('sys_drug_formulary', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 200);
                $table->string('generic_name', 200)->nullable();
                $table->string('strength', 50)->nullable();
                $table->string('dosage_form', 50)->nullable();
                $table->string('category', 50)->nullable();
                $table->boolean('is_high_alert')->default(false);
                $table->decimal('base_price', 15, 2)->default(0);
                $table->timestamps();
            });
        }

        // 2. Update Inventory to link to Formulary
        if (Schema::hasTable('inventory')) {
            Schema::table('inventory', function (Blueprint $table) {
                if (!Schema::hasColumn('inventory', 'formulary_id')) {
                    $table->uuid('formulary_id')->nullable()->after('id');
                    $table->integer('reorder_level')->default(10)->after('stock_level');
                }
            });
        }

        // 3. Stock Requisitions
        if (!Schema::hasTable('stock_requisitions')) {
            Schema::create('stock_requisitions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('pharmacy_item_id');
                $table->integer('requested_qty');
                $table->string('status', 20)->default('pending');
                $table->uuid('requested_by');
                $table->timestamp('dispatched_at')->nullable();
                $table->timestamp('received_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_requisitions');
        if (Schema::hasTable('inventory')) {
            Schema::table('inventory', function (Blueprint $table) {
                $table->dropColumn(['formulary_id', 'reorder_level']);
            });
        }
        Schema::dropIfExists('sys_drug_formulary');
    }
};
