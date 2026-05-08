<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionMatrixSeeder extends Seeder
{
    public function run()
    {
        DB::table("sys_role_permissions")->truncate();

        $matrix = [
            // Doctors & Specialists
            "Doctor" => ["module_clinical", "module_vitals", "module_emergency", "module_patients", "module_appointments", "module_messaging"],
            "Surgeon" => ["module_clinical", "module_vitals", "module_emergency", "module_patients", "module_appointments", "module_messaging"],
            "Paediatrician" => ["module_clinical", "module_vitals", "module_paeds", "module_emergency", "module_patients", "module_appointments", "module_messaging"],
            "Nephrologist" => ["module_clinical", "module_chronic", "module_patients", "module_appointments", "module_messaging"],
            
            // Nursing & Midwifery
            "Nurse" => ["module_clinical", "module_vitals", "module_emergency", "module_patients", "module_appointments", "module_messaging"],
            "Midwife" => ["module_clinical", "module_vitals", "module_maternal", "module_patients", "module_appointments", "module_messaging"],

            // Diagnostics
            "Lab" => ["module_lab", "module_messaging", "module_patients"],
            "LabTech" => ["module_lab", "module_messaging", "module_patients"],
            "Radiology" => ["module_radiology", "module_messaging", "module_patients"],
            "Radiologist" => ["module_radiology", "module_clinical", "module_messaging", "module_patients"],
            
            // Pharmacy & Supply Chain
            "Pharmacist" => ["module_pharmacy", "module_warehouse", "module_messaging", "module_patients"],
            "Storekeeper" => ["module_warehouse", "module_assets", "module_messaging"],
            "Store" => ["module_warehouse", "module_assets", "module_messaging"],
            
            // Finance & Administration
            "Accountant" => ["module_billing", "core_admin", "module_messaging"],
            "Admin" => ["core_admin", "module_warehouse", "module_billing", "module_assets", "module_tech", "module_patients", "module_appointments", "module_messaging"],
            "admin" => ["core_admin", "module_patients", "module_appointments", "module_messaging"],
            "TechSupport" => ["module_tech", "core_admin", "module_messaging"],
            "Tech" => ["module_tech", "core_admin", "module_messaging"],

            // Community & Outreach
            "CHW" => ["module_clinical", "module_vitals", "module_patients", "module_messaging"],
            "CHW Supervisor" => ["module_clinical", "module_vitals", "core_admin", "module_patients", "module_messaging"],
            "Surveillance Officer" => ["module_clinical", "core_admin", "module_patients", "module_messaging"],
            
            // Ancillary
            "Housekeeping" => ["module_assets", "module_messaging"],
            "Nutritionist" => ["module_clinical", "module_vitals", "module_patients", "module_messaging"],
            "Family Planning Counselor" => ["module_clinical", "module_maternal", "module_patients", "module_messaging"]
        ];

        $insertData = [];
        $branch_id = "00000000-0000-0000-0000-000000000001"; // Default branch ID

        foreach ($matrix as $role => $permissions) {
            foreach ($permissions as $perm) {
                $insertData[] = [
                    "role_name" => $role,
                    "permission_code" => $perm,
                    "branch_id" => $branch_id
                ];
            }
        }

        DB::table("sys_role_permissions")->insert($insertData);
        echo "Permission Matrix successfully seeded!\n";
    }
}

