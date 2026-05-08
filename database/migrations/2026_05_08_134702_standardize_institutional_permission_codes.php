<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $mappings = [
            'core_admin' => 'module_admin',
            'action_delete_record' => 'permission_delete_record',
            'action_export_data' => 'permission_export_data',
            'action_manage_catalog' => 'permission_manage_catalog',
            'action_verify_results' => 'permission_verify_results',
            'action_order_investigation' => 'permission_order_investigation',
            'action_manage_inventory' => 'permission_manage_inventory',
            'action_edit_emr' => 'permission_edit_emr',
            'action_void_billing' => 'permission_void_billing',
        ];

        DB::transaction(function() use ($mappings) {
            foreach ($mappings as $old => $new) {
                // 1. Create new permission record based on the old one
                $permission = DB::table('sys_permissions')->where('code', $old)->first();
                if ($permission) {
                    $newData = (array)$permission;
                    $newData['code'] = $new;
                    unset($newData['id']); // Allow auto-increment to handle ID
                    DB::table('sys_permissions')->insert($newData);
                    
                    // 2. Update role associations to the new code
                    DB::table('sys_role_permissions')->where('permission_code', $old)->update(['permission_code' => $new]);
                    
                    // 3. Delete the old permission record
                    DB::table('sys_permissions')->where('code', $old)->delete();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $mappings = [
            'module_admin' => 'core_admin',
            'permission_delete_record' => 'action_delete_record',
            'permission_export_data' => 'action_export_data',
            'permission_manage_catalog' => 'action_manage_catalog',
            'permission_verify_results' => 'action_verify_results',
            'permission_order_investigation' => 'action_order_investigation',
            'permission_manage_inventory' => 'action_manage_inventory',
            'permission_edit_emr' => 'action_edit_emr',
            'permission_void_billing' => 'action_void_billing',
        ];

        DB::transaction(function() use ($mappings) {
            foreach ($mappings as $old => $new) {
                $permission = DB::table('sys_permissions')->where('code', $old)->first();
                if ($permission) {
                    $newData = (array)$permission;
                    $newData['code'] = $new;
                    unset($newData['id']);
                    DB::table('sys_permissions')->insert($newData);
                    DB::table('sys_role_permissions')->where('permission_code', $old)->update(['permission_code' => $new]);
                    DB::table('sys_permissions')->where('code', $old)->delete();
                }
            }
        });
    }
};
