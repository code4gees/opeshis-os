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
        Schema::table('users', function (Blueprint $table) {
            // Add missing institutional columns
            if (!Schema::hasColumn('users', 'branch_id')) {
                $table->uuid('branch_id')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'staff_code')) {
                $table->string('staff_code', 20)->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 10)->nullable();
            }
            
            // Add other missing columns found in Tinker
            $columns = [
                'modified_by' => 'uuid',
                'last_seen' => 'timestamp',
                'assigned_branches' => 'json',
                'active_branch_id' => 'uuid',
                'department_id' => 'uuid',
                'job_title_id' => 'uuid',
                'dob' => 'date',
                'nationality' => 'string:100',
                'address' => 'text',
                'qualification' => 'text',
                'license_number' => 'string:100',
                'license_expiry' => 'date',
                'date_hired' => 'date',
                'bank_name' => 'string:100',
                'bank_account' => 'string:100',
                'emergency_contact_name' => 'string:200',
                'emergency_contact_phone' => 'string:20',
                'contract_type' => 'string:50',
                'sys_dept_id' => 'uuid',
                'sys_title_id' => 'uuid',
            ];

            foreach ($columns as $col => $type) {
                if (!Schema::hasColumn('users', $col)) {
                    if ($type === 'uuid') $table->uuid($col)->nullable();
                    elseif ($type === 'timestamp') $table->timestamp($col)->nullable();
                    elseif ($type === 'json') $table->json($col)->nullable();
                    elseif ($type === 'date') $table->date($col)->nullable();
                    elseif ($type === 'text') $table->text($col)->nullable();
                    elseif (str_starts_with($type, 'string:')) {
                        $len = (int)explode(':', $type)[1];
                        $table->string($col, $len)->nullable();
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback not strictly required for this institutional fix
        });
    }
};
