<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\NicuVital;
use App\Models\NicuFeeding;
use App\Actions\Clinical\AdmitNeonatalPatientAction;
use App\Services\ClinicalRiskService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NICUController extends Controller
{
    /**
     * Institutional NICU Command Hub
     */
    public function index(): View
    {
        $census = Admission::where('admission_type', 'nicu')
            ->when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->with(['patient', 'latestVital', 'latestFeeding'])
            ->where('status', 'admitted')
            ->orderBy('admission_date', 'desc')
            ->get();

        return view('clinical.nicu', compact('census'));
    }

    /**
     * Authorize Neonatal Admission via Action
     */
    public function admitBaby(Request $request, AdmitNeonatalPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid'],
            'mother_id' => ['required', 'uuid'],
            'birth_weight' => ['required', 'numeric'],
            'gestational_age' => ['required', 'integer'],
            'diagnosis' => ['required', 'string'],
        ]);

        try {
            // Resolve Identity
            $patient = \App\Models\Patient::where('id', $validated['patient_id'])
                ->orWhere('medical_id', $validated['patient_id'])
                ->firstOrFail();
            $validated['patient_id'] = $patient->id;

            $action->execute($validated);
            return redirect()->route('specialty.critical.nicu.index')->with('success', 'Neonatal admission protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.nicu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Neonatal Vitals with Intelligence Alerts via Action
     */
    public function logVitals(Request $request, \App\Actions\Clinical\LogNicuVitalsAction $action): RedirectResponse
    {
        $vitalsData = $request->validate([
            'admission_id' => ['required', 'uuid'],
            'temperature' => ['required', 'numeric'],
            'heart_rate' => ['required', 'integer'],
            'respiratory_rate' => ['required', 'integer'],
            'spo2' => ['required', 'integer'],
            'blood_glucose' => ['nullable', 'numeric'],
        ]);
        
        try {
            $result = $action->execute($vitalsData);
            $alerts = $result['alerts'];
            return redirect()->route('specialty.critical.nicu.index')->with('success', 'Neonatal vitals committed.' . (empty($alerts) ? '' : ' ⚠ Alerts triggered.'));
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.nicu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Feeding Log Record via Action
     */
    public function logFeeding(Request $request, \App\Actions\Clinical\LogNicuFeedingAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => ['required', 'uuid'],
            'feeding_type' => ['required', 'string'],
            'volume_ml' => ['required', 'numeric'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('specialty.critical.nicu.index')->with('success', 'Feeding protocol entry recorded.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.nicu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Phototherapy Initiation via Action
     */
    public function startPhototherapy(Request $request, string $id, \App\Actions\Clinical\StartNeonatalPhototherapyAction $action): RedirectResponse
    {
        try {
            $action->execute($id);
            return redirect()->route('specialty.critical.nicu.index')->with('success', 'Phototherapy initiation protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.nicu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Neonatal Discharge Protocol via Action
     */
    public function discharge(Request $request, string $id, \App\Actions\Clinical\DischargeNeonatalPatientAction $action): RedirectResponse
    {
        try {
            $action->execute($id);
            return redirect()->route('specialty.critical.nicu.index')->with('success', 'Discharge protocol finalized.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.nicu.index')->with('error', $e->getMessage());
        }
    }
}
