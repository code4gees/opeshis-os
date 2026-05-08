<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PsychPatient;
use App\Models\PsychMSE;
use App\Models\PsychRiskAssessment;
use App\Models\PsychMedication;
use App\Models\PsychEncounter;
use App\Actions\Clinical\RegisterPsychPatientAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PsychController extends Controller
{
    /**
     * Show Institutional Psychiatric Registry Command Hub
     */
    public function index(): View
    {
        $patients = PsychPatient::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with(['patient'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clinical.psych', compact('patients'));
    }

    /**
     * Authorize Institutional Psychiatric Registration Protocol via Action
     */
    public function register(Request $request, RegisterPsychPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'complaint' => ['required', 'string'],
            'source' => ['required', 'string'],
        ]);

        $action->execute($validated);

        return redirect()->back()->with('success', 'Institutional psychiatric registration protocol authorized.');
    }

    /**
     * Authorize Institutional Psychiatric Admission Protocol via Action
     */
    public function admit(Request $request, \App\Actions\Clinical\AdmitPsychPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'psych_patient_id' => ['required', 'uuid', 'exists:psych_patients,id'],
            'reason' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional psychiatric admission protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Institutional Psychiatric Discharge Protocol via Action
     */
    public function discharge(Request $request, string $id, \App\Actions\Clinical\DischargePsychPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'plan' => ['required', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional psychiatric discharge protocol finalized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Mental State Examination (MSE) Intelligence via Action
     */
    public function recordMSE(Request $request, \App\Actions\Clinical\RecordPsychMSEAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'psych_patient_id' => ['required', 'uuid', 'exists:psych_patients,id'],
            'appearance' => ['required', 'string'],
            'behaviour' => ['required', 'string'],
            'speech' => ['required', 'string'],
            'mood' => ['required', 'string'],
            'affect' => ['required', 'string'],
            'thought_form' => ['required', 'string'],
            'thought_content' => ['required', 'string'],
            'perception' => ['required', 'string'],
            'cognition' => ['required', 'string'],
            'insight' => ['required', 'string'],
            'judgement' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional MSE intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Psychiatric Risk Assessment Intelligence via Action
     */
    public function recordRisk(Request $request, \App\Actions\Clinical\RecordPsychRiskAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'psych_patient_id' => ['required', 'uuid', 'exists:psych_patients,id'],
            'suicidal' => ['required', 'string'],
            'self_harm' => ['required', 'string'],
            'violence' => ['required', 'string'],
            'risk_level' => ['required', 'string'],
            'protective' => ['nullable', 'string'],
            'safety_plan' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional risk assessment intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Psychiatric Medication Protocol via Action
     */
    public function prescribeMedication(Request $request, \App\Actions\Clinical\PrescribePsychMedAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'psych_patient_id' => ['required', 'uuid', 'exists:psych_patients,id'],
            'drug' => ['required', 'string'],
            'dose' => ['required', 'string'],
            'frequency' => ['required', 'string'],
            'route' => ['required', 'string'],
            'indication' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional psychiatric medication protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Psychiatric Encounter Intelligence via Action
     */
    public function recordEncounter(Request $request, \App\Actions\Clinical\RecordPsychEncounterAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'psych_patient_id' => ['required', 'uuid', 'exists:psych_patients,id'],
            'type' => ['required', 'string'],
            'notes' => ['required', 'string'],
            'progress' => ['required', 'string'],
            'plan' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional psychiatric encounter intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update Institutional Psychiatric Medication Intelligence via Action
     */
    public function updateMedication(Request $request, string $id, \App\Actions\Clinical\UpdatePsychMedAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'dose' => ['required', 'string'],
            'frequency' => ['required', 'string'],
            'status' => ['required', 'string'],
            'stop_reason' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional psychiatric medication intelligence updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
