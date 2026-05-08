<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$matrix = [
    // CLINICAL ELITE
    ['Doctor', 'module_clinical'], ['Doctor', 'module_vitals'], ['Doctor', 'module_emergency'], ['Doctor', 'module_maternal'], ['Doctor', 'module_paeds'], ['Doctor', 'module_chronic'], ['Doctor', 'module_telemedicine'],
    ['Surgeon', 'module_clinical'], ['Surgeon', 'module_vitals'], ['Surgeon', 'module_emergency'],
    ['Paediatrician', 'module_clinical'], ['Paediatrician', 'module_vitals'], ['Paediatrician', 'module_paeds'],
    ['Obstetrician', 'module_clinical'], ['Obstetrician', 'module_vitals'], ['Obstetrician', 'module_maternal'],
    ['Oncologist', 'module_clinical'], ['Oncologist', 'module_vitals'], ['Oncologist', 'module_chronic'],
    ['Psychiatrist', 'module_clinical'], ['Psychiatrist', 'module_vitals'],
    ['Nephrologist', 'module_clinical'], ['Nephrologist', 'module_chronic'],
    ['Neonatologist', 'module_clinical'], ['Neonatologist', 'module_paeds'],
    ['Anaesthetist', 'module_clinical'], ['Anaesthetist', 'module_emergency'],
    ['Dentist', 'module_clinical'], ['Dentist', 'module_vitals'],
    ['Ophthalmologist', 'module_clinical'], ['Ophthalmologist', 'module_vitals'],
    ['ENT Specialist', 'module_clinical'], ['ENT Specialist', 'module_vitals'],
    ['Dermatologist', 'module_clinical'], ['Dermatologist', 'module_vitals'],
    ['TB Coordinator', 'module_clinical'], ['TB Coordinator', 'module_chronic'],
    ['Malaria Focal Point', 'module_clinical'], ['Malaria Focal Point', 'module_chronic'],
    ['Medical Officer', 'module_clinical'], ['Medical Officer', 'module_vitals'],

    // NURSING & ALLIED
    ['Nurse', 'module_clinical'], ['Nurse', 'module_vitals'], ['Nurse', 'module_emergency'], ['Nurse', 'module_maternal'], ['Nurse', 'module_paeds'],
    ['Midwife', 'module_clinical'], ['Midwife', 'module_vitals'], ['Midwife', 'module_maternal'],
    ['Physiotherapist', 'module_clinical'], ['Physiotherapist', 'module_vitals'],
    ['Nutritionist', 'module_clinical'], ['Nutritionist', 'module_vitals'],
    ['Psychologist', 'module_clinical'], ['Psychologist', 'module_vitals'],
    ['Optometrist', 'module_clinical'], ['Optometrist', 'module_vitals'],
    ['Family Planning Counselor', 'module_clinical'], ['Family Planning Counselor', 'module_maternal'],
    ['Dialysis Tech', 'module_clinical'], ['Dialysis Tech', 'module_vitals'],
    ['CHW', 'module_clinical'], ['CHW', 'module_vitals'],
    ['CHW Supervisor', 'module_clinical'], ['CHW Supervisor', 'module_vitals'], ['CHW Supervisor', 'core_admin'],

    // DIAGNOSTICS
    ['Pharmacist', 'module_pharmacy'], ['Pharmacist', 'module_warehouse'],
    ['LabTech', 'module_lab'],
    ['Lab', 'module_lab'],
    ['Radiologist', 'module_radiology'], ['Radiologist', 'module_clinical'],
    ['Radiology', 'module_radiology'],

    // OPERATIONS
    ['Storekeeper', 'module_warehouse'], ['Storekeeper', 'module_assets'],
    ['Store', 'module_warehouse'], ['Store', 'module_assets'],
    ['Laundry', 'module_assets'],
    ['Housekeeping', 'module_assets'],

    // FINANCE & ADMIN
    ['Accountant', 'module_billing'], ['Accountant', 'core_admin'],
    ['CFO', 'module_billing'], ['CFO', 'core_admin'],
    ['Admin', 'core_admin'], ['Admin', 'module_warehouse'], ['Admin', 'module_billing'], ['Admin', 'module_assets'], ['Admin', 'module_tech'],
    ['admin', 'core_admin'],
    ['Tech', 'module_tech'], ['Tech', 'core_admin'],
    ['TechSupport', 'module_tech'], ['TechSupport', 'core_admin'],
    ['Surveillance Officer', 'module_clinical'], ['Surveillance Officer', 'core_admin'],
];

echo "PURGING STALE PERMISSION MATRIX...\n";
DB::table('sys_role_permissions')->truncate();

echo "SEEDING INSTITUTIONAL MATRIX (ALL ROLES)...\n";
foreach ($matrix as $entry) {
    DB::table('sys_role_permissions')->insert([
        'role_name' => $entry[0],
        'permission_code' => $entry[1]
    ]);
}

echo "MATRIX SYNCHRONIZED SUCCESSFULLY.\n";
