<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NutritionCase;
use App\Models\NutritionVisit;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NutritionController extends Controller
{
    /**
     * Institutional Nutrition Surveillance Command Hub
     */
    public function index(): View
    {
        $patients = NutritionCase::with(['patient', 'visits'])
            ->where('status', 'active')
            ->get();

        $stock = \App\Models\NutritionStock::get();

        return view('clinical.nutrition', compact('patients', 'stock'));
    }

    /**
     * Authorize Institutional Nutrition Case Admission Protocol
     */
    public function admitPatient(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid'],
            'reason' => ['required', 'string'],
            'status_type' => ['required', 'string'],
            'weight' => ['required', 'numeric'],
            'muac' => ['required', 'numeric'],
            'oedema' => ['nullable', 'boolean'],
        ]);

        $case = NutritionCase::create([
            'patient_id' => $validated['patient_id'],
            'admission_reason' => $validated['reason'],
            'nutritional_status' => $validated['status_type'],
            'weight_kg' => $validated['weight'],
            'muac_cm' => $validated['muac'],
            'oedema' => (bool) ($validated['oedema'] ?? false),
            'status' => 'active',
            'admitted_by' => auth()->id(),
        ]);

        Opeshis::logAction('NUTRITION_ADMIT', 'nutrition_cases', $case->id, "Reason: {$validated['reason']}");

        return redirect()->back()->with('success', 'Institutional nutrition admission protocol authorized.');
    }

    /**
     * Finalize Institutional Nutrition Case Discharge Protocol
     */
    public function dischargePatient(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'weight' => ['required', 'numeric'],
            'outcome' => ['required', 'string'],
        ]);

        NutritionCase::findOrFail($id)->update([
            'status' => 'discharged',
            'discharge_weight' => $validated['weight'],
            'outcome' => $validated['outcome'],
            'discharged_at' => now(),
            'discharged_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional discharge protocol finalized.');
    }

    /**
     * Commit Nutritional Follow-up Intelligence Protocol
     */
    public function recordVisit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid'],
            'weight' => ['required', 'numeric'],
            'muac' => ['required', 'numeric'],
            'food_issued' => ['nullable', 'string'],
            'complications' => ['nullable', 'string'],
        ]);

        NutritionVisit::create([
            'case_id' => $validated['case_id'],
            'weight_kg' => $validated['weight'],
            'muac_cm' => $validated['muac'],
            'therapeutic_food_issued' => $validated['food_issued'],
            'complications' => $validated['complications'],
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Nutritional follow-up intelligence committed.');
    }
}

