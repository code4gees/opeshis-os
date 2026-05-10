<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\IncidentReport;

class IncidentTest extends TestCase
{
    use RefreshDatabase;

    public function test_incident_index_renders(): void
    {
        $user = User::factory()->create(['role' => 'Admin']);
        
        \Illuminate\Support\Facades\DB::table('sys_roles')->insertOrIgnore(['name' => 'Admin', 'description' => 'System Admin']);
        \Illuminate\Support\Facades\DB::table('sys_permissions')->insertOrIgnore(['code' => 'module_clinical', 'name' => 'Clinical Access', 'category' => 'Core']);
        \Illuminate\Support\Facades\DB::table('sys_role_permissions')->insertOrIgnore(['role_name' => 'Admin', 'permission_code' => 'module_clinical']);
        
        \Illuminate\Support\Facades\Cache::flush();
        
        $response = $this->actingAs($user)->get(route('operations.clinical.incidents.index'));

        $response->assertStatus(200);
    }

    public function test_can_submit_incident(): void
    {
        $user = User::factory()->create(['role' => 'Admin']);
        
        \Illuminate\Support\Facades\DB::table('sys_roles')->insertOrIgnore(['name' => 'Admin', 'description' => 'System Admin']);
        \Illuminate\Support\Facades\DB::table('sys_permissions')->insertOrIgnore(['code' => 'module_clinical', 'name' => 'Clinical Access', 'category' => 'Core']);
        \Illuminate\Support\Facades\DB::table('sys_role_permissions')->insertOrIgnore(['role_name' => 'Admin', 'permission_code' => 'module_clinical']);
        
        \Illuminate\Support\Facades\Cache::flush();
        
        $response = $this->actingAs($user)->post(route('operations.clinical.incidents.submit'), [
            'type' => 'Near Miss',
            'incident_date' => now()->format('Y-m-d'),
            'location' => 'Institutional Pharmacy',
            'description' => 'Medication near miss during dispensing protocol.',
            'immediate_action' => 'Dispensing halted for verification.',
            'severity' => 'low',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('incident_reports', [
            'incident_type' => 'Near Miss',
            'location' => 'Institutional Pharmacy',
        ]);
    }

    public function test_can_investigate_incident(): void
    {
        $user = User::factory()->create(['role' => 'Admin']);
        
        \Illuminate\Support\Facades\DB::table('sys_roles')->insertOrIgnore(['name' => 'Admin', 'description' => 'System Admin']);
        \Illuminate\Support\Facades\DB::table('sys_permissions')->insertOrIgnore(['code' => 'module_clinical', 'name' => 'Clinical Access', 'category' => 'Core']);
        \Illuminate\Support\Facades\DB::table('sys_role_permissions')->insertOrIgnore(['role_name' => 'Admin', 'permission_code' => 'module_clinical']);
        
        \Illuminate\Support\Facades\Cache::flush();

        $incident = IncidentReport::create([
            'incident_type' => 'Equipment Failure',
            'date_of_incident' => now()->format('Y-m-d'),
            'location' => 'OT_1',
            'description' => 'Defibrillator failure signal.',
            'severity' => 'high',
            'reported_by' => $user->id,
        ]);

        $response = $this->actingAs($user)->post(route('operations.clinical.incidents.investigate', ['id' => $incident->id]), [
            'root_cause' => 'Battery depletion due to failed charging protocol.',
            'action' => 'Replacement of battery unit and audit of charging matrix.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('incident_reports', [
            'id' => $incident->id,
            'status' => 'investigated',
            'root_cause' => 'Battery depletion due to failed charging protocol.',
            'investigated_by' => $user->id,
        ]);
    }
}
