<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the dashboard renders correctly with the new components.
     */
    public function test_dashboard_renders_for_authorized_user(): void
    {
        $user = User::factory()->create([
            'role' => 'Admin'
        ]);

        // Seed role and permission for dashboard components to show up
        \Illuminate\Support\Facades\DB::table('sys_roles')->insertOrIgnore([
            'name' => 'Admin',
            'description' => 'Administrator'
        ]);
        \Illuminate\Support\Facades\DB::table('sys_permissions')->insertOrIgnore([
            'code' => 'module_clinical',
            'name' => 'Clinical Module',
            'category' => 'Clinical'
        ]);
        \Illuminate\Support\Facades\DB::table('sys_role_permissions')->insertOrIgnore([
            'role_name' => 'Admin',
            'permission_code' => 'module_clinical'
        ]);

        \Illuminate\Support\Facades\Cache::flush();

        $response = $this->actingAs($user)->get('/dashboard?force_dashboard=1');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Clinical Inflow Intelligence');
        $response->assertSee('Institutional Live Queue');
    }

    /**
     * Test PII Protection in Patient Model.
     */
    public function test_patient_pii_is_automatically_encrypted(): void
    {
        $patient = \App\Models\Patient::create([
            'medical_id' => 'TEST-' . rand(1000, 9999),
            'full_name' => 'Secret Patient Name',
            'gender' => 'Male',
            'dob' => '1990-01-01'
        ]);

        // Check DB raw value (should be encrypted)
        $raw = \Illuminate\Support\Facades\DB::table('patients')->where('id', $patient->id)->first();
        $this->assertNotEquals('Secret Patient Name', $raw->full_name);
        
        // Check Model value (should be decrypted)
        $this->assertEquals('Secret Patient Name', $patient->full_name);
    }
}
