<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstitutionalSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Initial Medical Terms (ICD-10 Sample)
        $terms = [
            ['code' => 'A00.0', 'term_name' => 'Cholera due to Vibrio cholerae 01, biovar cholerae', 'category' => 'Infectious'],
            ['code' => 'B50.0', 'term_name' => 'Plasmodium falciparum malaria with cerebral complications', 'category' => 'Infectious'],
            ['code' => 'E11.9', 'term_name' => 'Type 2 diabetes mellitus without complications', 'category' => 'Endocrine'],
            ['code' => 'I10', 'term_name' => 'Essential (primary) hypertension', 'category' => 'Circulatory'],
            ['code' => 'J45.9', 'term_name' => 'Asthma, unspecified', 'category' => 'Respiratory'],
        ];
        foreach ($terms as $t) {
            DB::table('sys_medical_terms')->insertOrIgnore($t);
        }

        // 2. Wards & Beds
        $wardId = (string) Str::uuid();
        DB::table('sys_wards')->insertOrIgnore([
            'id' => $wardId,
            'name' => 'Saint Mary Intensive Care',
            'category' => 'ICU',
            'capacity' => 10
        ]);

        for ($i = 1; $i <= 5; $i++) {
            DB::table('sys_beds')->insertOrIgnore([
                'id' => (string) Str::uuid(),
                'ward_id' => $wardId,
                'bed_number' => "ICU-BED-$i",
                'status' => 'available'
            ]);
        }

        // 3. Initial Inventory (Pharmacy & Warehouse)
        $invItems = [
            ['id' => (string) Str::uuid(), 'item_name' => 'Paracetamol 500mg', 'category' => 'Analgesic', 'stock_level' => 5000, 'unit_price' => 50],
            ['id' => (string) Str::uuid(), 'item_name' => 'Amoxicillin 250mg', 'category' => 'Antibiotic', 'stock_level' => 1200, 'unit_price' => 150],
            ['id' => (string) Str::uuid(), 'item_name' => 'Artemether-Lumefantrine', 'category' => 'Antimalarial', 'stock_level' => 800, 'unit_price' => 2500],
        ];
        foreach ($invItems as $item) {
            DB::table('inventory')->insertOrIgnore($item);
        }

        // 4. Insurance Providers
        DB::table('insurance_providers')->insertOrIgnore([
            'id' => (string) Str::uuid(),
            'name' => 'CNAM National Health',
            'code' => 'CNAM-001',
            'default_co_pay_rate' => 20
        ]);

        // 5. Blood Bank
        $groups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        foreach ($groups as $g) {
            DB::table('sys_blood_bank')->insertOrIgnore([
                'id' => (string) Str::uuid(),
                'blood_group' => $g,
                'units_available' => rand(5, 50),
                'last_update' => now(),
                'created_at' => now()
            ]);
        }
    }
}
