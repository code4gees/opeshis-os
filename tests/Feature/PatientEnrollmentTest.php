<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\Opeshis;

class PatientEnrollmentTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup dependencies for patient registration
        DB::table('medical_id_pool')->insert([
            'medical_id' => 'MED-12345',
            'status' => 'unassigned',
        ]);
        
        // Insert a basic role and permission to allow the user to bypass middleware if needed
        DB::table('sys_roles')->insert(['name' => 'admin', 'description' => 'Admin']);
        DB::table('sys_permissions')->insert(['code' => 'module_patients', 'name' => 'Patients', 'category' => 'clinical']);
        DB::table('sys_role_permissions')->insert(['role_name' => 'admin', 'permission_code' => 'module_patients']);
    }

    public function test_can_register_new_patient_with_valid_data(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $this->withoutExceptionHandling();
        $response = $this->actingAs($user)->post('/registry/patients/register', [
            'full_name' => 'John Doe',
            'gender' => 'male',
            'phone' => '1234567890',
            'dob' => '1990-01-01',
        ]);

        $response->assertSessionHas('success');
        $response->assertRedirect();
    }

    public function test_cannot_register_patient_without_required_fields(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->post('/registry/patients/register', [
            'gender' => 'male',
        ]);

        $response->assertSessionHasErrors(['full_name']);
    }
}
