<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use App\Models\ActiveQueue;
use App\Models\OpdEncounter;
use App\Models\BillingInvoice;
use Illuminate\Support\Facades\DB;

/**
 * INSTITUTIONAL AUDIT PROOF SUITE
 * This suite demonstrates the critical gaps identified during the May 2026 Audit.
 */
class InstitutionalAuditProofTest extends TestCase
{
    use RefreshDatabase;

    /**
     * VERIFICATION: Specialty Infrastructure Restored
     */
    public function test_specialty_infrastructure_is_restored(): void
    {
        // Should no longer throw QueryException
        $count = DB::table('onco_registry')->count();
        $this->assertEquals(0, $count);
    }

    /**
     * VERIFICATION: Clinical Flow Unification (Triage to OPD)
     */
    public function test_triage_to_opd_linkage_restored(): void
    {
        $patient = Patient::factory()->create();

        // 1. Triage Capture
        $queue = ActiveQueue::create([
            'patient_id' => $patient->id,
            'vitals_data' => ['temp' => 38.5, 'bp_sys' => 120, 'bp_dia' => 80],
            'status' => 'awaiting_consultation'
        ]);

        // 2. OPD Registration with linkage
        $user = User::factory()->create(['role' => 'System Core']);
        $response = $this->actingAs($user)->post(route('clinical.opd.register'), [
            'patient_id' => $patient->id,
            'active_queue_id' => (string) $queue->id,
            'department' => 'General Medicine',
            'visit_type' => 'Consultation'
        ]);

        $encounter = OpdEncounter::where('patient_id', $patient->id)->first();

        // ASSERT: The encounter IS now linked to the triage record
        $this->assertNotNull($encounter, "Encounter was not created.");
        $this->assertEquals($queue->id, $encounter->active_queue_id, "OPD Encounter is successfully linked to Triage data.");
    }

    /**
     * PROOF: Financial Audit Failure
     * Demonstrates that invoices can reach 'paid' status without forensic trail logs.
     */
    public function test_billing_forensic_audit_gap(): void
    {
        $patient = Patient::factory()->create();
        $invoice = BillingInvoice::create([
            'invoice_number' => 'INV-AUDIT-001',
            'patient_id' => $patient->id,
            'total_amount' => 5000,
            'patient_due_amount' => 5000,
            'status' => 'paid'
        ]);

        // Check for mismatch: Paid status exists but no BILLING_PAYMENT action was logged.
        $hasAuditLog = DB::table('sys_audit_log')
            ->where('table_name', 'billing_invoices')
            ->where('record_id', $invoice->id)
            ->where('action', 'BILLING_PAYMENT')
            ->exists();

        $this->assertFalse($hasAuditLog, "Financial status mutated to 'paid' without a corresponding BILLING_PAYMENT audit log.");
    }

    /**
     * PROOF: Registration Validation Bug
     * Demonstrates that the registration form is missing a required field (dob).
     */
    public function test_registration_validation_mismatch(): void
    {
        $user = User::factory()->create(['role' => 'System Core']);

        // Form in resources/views/patients/index.blade.php only provides full_name, gender, phone.
        // But StorePatientRequest.php requires 'dob'.
        $response = $this->actingAs($user)->post('/registry/patients/register', [
            'full_name' => 'John Auditor',
            'gender' => 'Male', // Form uses capitalized 'Male', validation requires lowercase 'male'
            'phone' => '123456789'
        ]);

        $response->assertSessionHasErrors(['dob', 'gender']);
    }
}
