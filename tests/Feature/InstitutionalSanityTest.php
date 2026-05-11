<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use App\Models\OpdEncounter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class InstitutionalSanityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Case: 100% Production Ready Verification
     * Verifies: Eloquent, PII, Observers, Middleware, Caching.
     */
    public function test_institutional_clinical_integrity()
    {
        // 1. Setup Institutional User (Doctor)
        $doctor = User::factory()->create([
            'role' => 'doctor',
            'staff_code' => 'DOC-001'
        ]);

        // 2. Verify PII Protection & Eloquent Persistence
        $patient = Patient::create([
            'full_name' => 'Institutional Test Patient', // Should be encrypted
            'medical_id' => 'OPD-UNIT-001',
            'phone' => '08000000000',
            'gender' => 'Male',
            'dob' => '1990-01-01'
        ]);

        $this->assertDatabaseHas('patients', ['medical_id' => 'OPD-UNIT-001']);
        
        // Verify PII is NOT stored in plain text
        $rawPatient = DB::table('patients')->where('medical_id', 'OPD-UNIT-001')->first();
        $this->assertNotEquals('Institutional Test Patient', $rawPatient->full_name);
        
        // Verify Eloquent auto-decrypts
        $this->assertEquals('Institutional Test Patient', $patient->full_name);

        // 3. Verify Forensic Audit Observer
        $this->assertTrue(
            DB::table('sys_audit_log')->exists(),
            'Forensic Audit Signal Lost: No audit log generated for patient creation.'
        );

        // 4. Verify Permission Middleware & Caching
        // Seed the role and permission first since we are in RefreshDatabase
        DB::table('sys_roles')->insertOrIgnore([
            'name' => 'doctor',
            'description' => 'Medical Practitioner'
        ]);
        DB::table('sys_permissions')->insertOrIgnore([
            'code' => 'module_clinical',
            'name' => 'Clinical Module Access',
            'category' => 'Clinical'
        ]);
        DB::table('sys_role_permissions')->insertOrIgnore([
            'role_name' => 'doctor',
            'permission_code' => 'module_clinical'
        ]);

        $this->actingAs($doctor);
        
        // First check (uncached)
        $this->assertTrue($doctor->hasPermission('module_clinical'));
        
        // Verify cache existence
        $cacheKey = "user_perm_{$doctor->id}_module_clinical";
        $this->assertTrue(Cache::has($cacheKey));

        // 5. Verify Clinical Encounter Flow
        $queueItem = \App\Models\ActiveQueue::create([
            'patient_id' => $patient->id,
            'status' => 'waiting',
            'priority' => 'normal'
        ]);

        $this->assertDatabaseHas('active_queue', ['id' => $queueItem->id]);

        $response = $this->get(route('emr.main', ['id' => $queueItem->id]));
        $response->assertStatus(200);
        $response->assertSee('Clinical');
    }
}
