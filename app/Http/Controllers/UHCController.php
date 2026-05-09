<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\EClaim;
use App\Models\InsuranceProvider;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class UHCController extends Controller
{
    /**
     * Show Institutional UHC & Social Health Monitor Hub
     */
    public function index(): View
    {
        // Fetch Patient Enrollments (Linked to Insurance Providers)
        $enrollments = Patient::whereNotNull('insurance_provider_id')
            ->whereNotNull('insurance_policy_number')
            ->with('insuranceProvider')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function($p) {
                return (object) [
                    'id' => $p->id,
                    'full_name' => $p->full_name,
                    'medical_id' => $p->medical_id,
                    'uhc_id' => $p->insurance_policy_number,
                    'scheme_name' => optional($p->insuranceProvider)->name ?? 'Institutional UBC',
                ];
            });

        // Fetch Recent Insurance Claims
        $recentClaims = EClaim::with('patient')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($c) {
                return (object) [
                    'insurance_claim_id' => substr($c->id, 0, 8),
                    'claim_status' => $c->status,
                    'full_name' => optional($c->patient)->full_name ?? 'UNKNOWN',
                    'total_amount' => $c->total_claimed,
                ];
            });

        return view('uhc.index', compact('enrollments', 'recentClaims'));
    }

    /**
     * Authorize Institutional-National Health Linkage Enrollment
     */
    public function enroll(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|string',
            'uhc_id' => 'required|string',
            'scheme' => 'required|string',
        ]);

        try {
            // Resolve Identity
            $patient = Patient::where('id', $validated['patient_id'])
                ->orWhere('medical_id', $validated['patient_id'])
                ->firstOrFail();

            // Resolve Provider (or create/find by scheme name)
            $provider = InsuranceProvider::firstOrCreate(
                ['name' => $validated['scheme']],
                ['status' => 'active']
            );

            // Update Linkage
            $patient->update([
                'insurance_provider_id' => $provider->id,
                'insurance_policy_number' => $validated['uhc_id'],
            ]);

            Opeshis::logAction('UHC_LINK', 'patients', $patient->id, "Protocol: Institutional-National Health Linkage established for ID #{$validated['uhc_id']}.");

            return redirect()->back()->with('success', 'Institutional-National health linkage protocol established.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Operational disruption: ' . $e->getMessage());
        }
    }
}
