<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EClaim;
use App\Models\InsuranceProvider;
use App\Actions\Finance\SubmitEClaimAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EClaimsController extends Controller
{
    /**
     * Institutional E-Claims Command Hub
     */
    public function index(): View
    {
        $claims = EClaim::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->with(['patient', 'provider'])
            ->orderBy('created_at', 'desc')
            ->get();

        $providers = InsuranceProvider::all();

        return view('billing.eclaims', compact('claims', 'providers'));
    }

    /**
     * Authorize Institutional E-Claim Submission Protocol via Action
     */
    public function createClaim(Request $request, SubmitEClaimAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'provider_id' => 'required|uuid|exists:insurance_providers,id',
            'encounter_date' => 'required|date',
            'diagnosis_codes' => 'required|string',
            'total' => 'required|numeric',
        ]);

        try {
            $claim = $action->execute($validated);
            return redirect()->back()->with('success', "Institutional eClaim {$claim->claim_number} submitted and authorized.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional E-Claim Verification Protocol via Action
     */
    public function verify(Request $request, string $id, \App\Actions\Finance\VerifyEClaimAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string', // approved, rejected, queried
            'notes' => 'nullable|string',
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', "Institutional claim verification protocol completed.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
