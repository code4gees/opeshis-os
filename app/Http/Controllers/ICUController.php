<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admission;
use App\Actions\Clinical\AdmitIcuPatientAction;
use App\Actions\Clinical\LogIcuVitalsAction;
use App\Actions\Clinical\DischargePatientAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ICUController extends Controller
{
    /**
     * Show Institutional Critical Care Command Center
     */
    public function index(): View
    {
        $census = Admission::where('admission_type', 'icu')
            ->when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->with(['patient', 'latestVital', 'latestSofa'])
            ->where('status', 'admitted')
            ->orderBy('admission_date', 'desc')
            ->get();

        return view('clinical.icu', compact('census'));
    }

    /**
     * Authorize Institutional Critical Care Admission Protocol via Action
     */
    public function admit(Request $request, AdmitIcuPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'bed_number' => 'required|string',
            'diagnosis' => 'required|string',
            'source' => 'nullable|string',
        ]);

        try {
            // Resolve Identity
            $patient = \App\Models\Patient::where('id', $validated['patient_id'])
                ->orWhere('medical_id', $validated['patient_id'])
                ->firstOrFail();
            $validated['patient_id'] = $patient->id;

            $action->execute($validated);
            return redirect()->route('specialty.critical.icu.index')->with('success', 'Institutional critical care admission protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.icu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Hemodynamic Vitals Protocol via Action
     */
    public function logVitals(Request $request, LogIcuVitalsAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'bp_systolic' => 'nullable|numeric',
            'bp_diastolic' => 'nullable|numeric',
            'heart_rate' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'gcs' => 'nullable|numeric',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('specialty.critical.icu.index')->with('success', 'Hemodynamic vitals committed to institutional archive.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.icu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional SOFA Index Calculation Protocol via Action
     */
    public function saveSOFA(Request $request, \App\Actions\Clinical\CalculateSofaScoreAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'respiratory' => 'required|integer|min:0|max:4',
            'coagulation' => 'required|integer|min:0|max:4',
            'liver' => 'required|integer|min:0|max:4',
            'cardiovascular' => 'required|integer|min:0|max:4',
            'cns' => 'required|integer|min:0|max:4',
            'renal' => 'required|integer|min:0|max:4',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('specialty.critical.icu.index')->with('success', 'Institutional SOFA strategic index updated.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.icu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Institutional ICU Discharge Protocol via Action
     */
    public function discharge(Request $request, string $id, DischargePatientAction $action): RedirectResponse
    {
        try {
            $action->execute($id, $request->only('destination'));
            return redirect()->route('specialty.critical.icu.index')->with('success', 'Institutional critical care discharge protocol finalized.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.icu.index')->with('error', $e->getMessage());
        }
    }
}
