<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'Doctor', 'Surgeon', 'Paediatrician', 'Nephrologist',
            'Nurse', 'Midwife',
            'Lab', 'LabTech', 'Radiology', 'Radiologist',
            'Pharmacist', 'Storekeeper', 'Store',
            'Accountant', 'Admin', 'admin', 'TechSupport', 'Tech',
            'CHW', 'CHW Supervisor', 'Surveillance Officer',
            'Housekeeping', 'Nutritionist', 'Family Planning Counselor'
        ];

        foreach ($roles as $role) {
            DB::table('sys_roles')->updateOrInsert(['name' => $role], ['name' => $role, 'description' => "Institutional $role Role"]);
        }

        echo "Roles successfully seeded!\n";
    }
}
