<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Core Access
            ['code' => 'core_admin', 'name' => 'System Administration', 'category' => 'System'],
            ['code' => 'module_tech', 'name' => 'Technical Support', 'category' => 'System'],
            
            // Patient & Appointments
            ['code' => 'module_patients', 'name' => 'Patient Registry Access', 'category' => 'Clinical'],
            ['code' => 'module_appointments', 'name' => 'Appointment Management', 'category' => 'Clinical'],
            ['code' => 'module_messaging', 'name' => 'Institutional Messaging', 'category' => 'Communication'],
            
            // Clinical Services
            ['code' => 'module_clinical', 'name' => 'EMR & Clinical Consultations', 'category' => 'Clinical'],
            ['code' => 'module_vitals', 'name' => 'Triage & Vital Signs', 'category' => 'Clinical'],
            ['code' => 'module_emergency', 'name' => 'Emergency & Trauma Care', 'category' => 'Clinical'],
            ['code' => 'module_maternal', 'name' => 'Maternal & ANC Health', 'category' => 'Clinical'],
            ['code' => 'module_paeds', 'name' => 'Pediatrics & NICU', 'category' => 'Clinical'],
            ['code' => 'module_chronic', 'name' => 'Chronic Care (NCD)', 'category' => 'Clinical'],
            ['code' => 'module_telemedicine', 'name' => 'Virtual Consultations', 'category' => 'Clinical'],
            
            // Diagnostics & Support
            ['code' => 'module_pharmacy', 'name' => 'Pharmacy & Dispensary', 'category' => 'Support'],
            ['code' => 'module_lab', 'name' => 'Laboratory Services', 'category' => 'Diagnostics'],
            ['code' => 'module_radiology', 'name' => 'Radiology & Imaging', 'category' => 'Diagnostics'],
            
            // Operations & Finance
            ['code' => 'module_warehouse', 'name' => 'Inventory & Stock Control', 'category' => 'Operations'],
            ['code' => 'module_assets', 'name' => 'Asset Register', 'category' => 'Operations'],
            ['code' => 'module_billing', 'name' => 'Billing & Financial Management', 'category' => 'Finance'],
        ];

        foreach ($permissions as $p) {
            DB::table('sys_permissions')->updateOrInsert(['code' => $p['code']], $p);
        }

        echo "Permissions successfully seeded!\n";
    }
}
