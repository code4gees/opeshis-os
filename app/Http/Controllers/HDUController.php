<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\HduVital;
use App\Actions\Clinical\AdmitHduPatientAction;
use App\Actions\Clinical\LogHduVitalsAction;
use App\Actions\Clinical\EscalatePatientToIcuAction;
use App\Actions\Clinical\DischargePatientAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HDUController extends Controller
{
    /**
     * Institutional HDU Command Hub
     */
    public function index(): View
    {
        $census = Admission::where('admission_type', 'hdu')
            ->when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->with(['patient', 'hduVitals'])
            ->where('status', 'admitted')
            ->orderBy('admission_date', 'desc')
            ->get()
            ->map(function ($admission) {
                $admission->latest_vital = $admission->hduVitals()->latest()->first();
                return $admission;
            });

        return view('clinical.hdu', compact('census'));
    }

    /**
     * Authorize Institutional High Dependency Admission Protocol via Action
     */
    public function admit(Request $request, AdmitHduPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'bed_number' => 'required|string',
            'diagnosis' => 'required|string',
        ]);

        try {
            // Resolve Identity
            $patient = \App\Models\Patient::where('id', $validated['patient_id'])
                ->orWhere('medical_id', $validated['patient_id'])
                ->firstOrFail();
            $validated['patient_id'] = $patient->id;

            $action->execute($validated);
            return redirect()->route('specialty.critical.hdu.index')->with('success', 'High dependency admission authorized.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.hdu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Hemodynamic Vitals Protocol via Action
     */
    public function logVitals(Request $request, LogHduVitalsAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'bp_systolic' => 'nullable|numeric',
            'bp_diastolic' => 'nullable|numeric',
            'heart_rate' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('specialty.critical.hdu.index')->with('success', 'HDU hemodynamic vitals committed.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.hdu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Escalation to ICU Protocol via Action
     */
    public function escalateToICU(Request $request, string $id, EscalatePatientToIcuAction $action): RedirectResponse
    {
        try {
            $action->execute($id);
            return redirect()->route('specialty.critical.hdu.index')->with('success', 'Patient escalation to ICU authorized.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.hdu.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Institutional HDU Discharge Protocol via Action
     */
    public function discharge(Request $request, string $id, DischargePatientAction $action): RedirectResponse
    {
        try {
            $action->execute($id, $request->only('notes'));
            return redirect()->route('specialty.critical.hdu.index')->with('success', 'Discharge protocol finalized.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.critical.hdu.index')->with('error', $e->getMessage());
        }
    }
}
