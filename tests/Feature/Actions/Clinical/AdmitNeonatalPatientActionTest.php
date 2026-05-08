<?php

declare(strict_types=1);

namespace Tests\Feature\Actions\Clinical;

use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use App\Models\NicuAdmission;
use App\Actions\Clinical\AdmitNeonatalPatientAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class AdmitNeonatalPatientActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_admit_a_neonate_to_nicu(): void
    {
        $user = User::factory()->create(['role' => 'Physician']);
        $baby = Patient::create([
            'id' => Str::uuid(),
            'full_name' => 'Baby Doe',
            'medical_id' => 'B-001',
            'gender' => 'Male',
            'dob' => now()->toDateString(),
        ]);
        $mother = Patient::create([
            'id' => Str::uuid(),
            'full_name' => 'Jane Doe',
            'medical_id' => 'M-001',
            'gender' => 'Female',
            'dob' => '1990-01-01',
        ]);

        $action = new AdmitNeonatalPatientAction();
        
        $this->actingAs($user);

        $admission = $action->execute([
            'patient_id' => $baby->id,
            'mother_id' => $mother->id,
            'birth_weight' => 2.5,
            'gestational_age' => 38,
            'diagnosis' => 'Institutional Neonatal Protocol',
        ]);

        $this->assertDatabaseHas('nicu_admissions', [
            'id' => $admission->id,
            'birth_weight' => 2.5,
            'gestational_age' => 38,
            'status' => 'admitted',
        ]);

        $this->assertDatabaseHas('sys_audit_log', [
            'table_name' => 'nicu_admissions',
            'record_id' => $admission->id,
            'action' => 'CREATE_NICU_ADMISSIONS',
        ]);
    }
}
