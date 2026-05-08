<?php

declare(strict_types=1);

namespace Tests\Feature\Actions\Clinical;

use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use App\Models\OpdEncounter;
use App\Actions\Clinical\AdmitIcuPatientAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdmitIcuPatientActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_admit_a_patient_to_icu(): void
    {
        $user = User::factory()->create(['role' => 'Physician']);
        $patient = Patient::factory()->create();
        $encounter = OpdEncounter::factory()->create(['patient_id' => $patient->id]);

        $action = new AdmitIcuPatientAction();
        
        $this->actingAs($user);

        $admission = $action->execute([
            'patient_id' => $patient->id,
            'visit_id' => $encounter->id,
            'bed_number' => 'ICU-01',
            'severity' => 'critical',
            'diagnosis' => 'Septic Shock Protocol',
        ]);
 
        $this->assertDatabaseHas('admissions', [
            'id' => $admission->id,
            'admission_type' => 'icu',
            'status' => 'admitted',
        ]);
 
        $this->assertDatabaseHas('sys_audit_log', [
            'table_name' => 'admissions',
            'record_id' => $admission->id,
            'action' => 'ICU_ADMIT',
        ]);
    }
}
