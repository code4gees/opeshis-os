<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RadiologyOrderTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        DB::table('sys_roles')->insert(['name' => 'doctor', 'description' => 'Doctor']);
        DB::table('sys_permissions')->insert(['code' => 'module_radiology', 'name' => 'Radiology', 'category' => 'clinical']);
        DB::table('sys_role_permissions')->insert(['role_name' => 'doctor', 'permission_code' => 'module_radiology']);
        
        DB::table('sys_radiology_catalog')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'Chest X-Ray',
            'category' => 'X-Ray',
            'price' => 5000,
        ]);
    }

    public function test_can_create_quick_radiology_order(): void
    {
        $user = User::factory()->create(['role' => 'doctor']);
        $patientId = (string) Str::uuid();
        
        DB::table('patients')->insert([
            'id' => $patientId,
            'medical_id' => 'MED-111',
            'full_name' => 'Encrypted',
            'gender' => 'female',
            'dob' => '1990-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->withoutExceptionHandling();
        $response = $this->actingAs($user)->post('/radiology/order', [
            'patient_id' => $patientId,
            'test_name' => 'Chest X-Ray',
            'indications' => 'Persistent cough',
        ]);

        $response->assertSessionHas('success');
        $response->assertRedirect();
    }

    public function test_cannot_order_without_patient_id(): void
    {
        $user = User::factory()->create(['role' => 'doctor']);

        $response = $this->actingAs($user)->post('/radiology/order', [
            'test_name' => 'Chest X-Ray',
        ]);

        $response->assertSessionHasErrors(['patient_id']);
    }
}
