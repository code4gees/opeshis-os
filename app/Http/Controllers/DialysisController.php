<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DialysisPatient;
use App\Models\DialysisSession;
use App\Models\DialysisMachine;
use App\Models\DialysisVital;
use App\Models\DialysisPdSession;
use App\Models\DialysisLab;
use App\Actions\Clinical\RegisterRenalPatientAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DialysisController extends Controller
{
    /**
     * Show Institutional Renal Command Hub
     */
    public function index(): View
    {
        $patients = DialysisPatient::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with(['patient', 'activeSession'])
            ->withCount('sessions')
            ->where('status', 'active')
            ->get();

        $machines = DialysisMachine::all();
        
        $todaySessions = DialysisSession::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient.patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with(['patient.patient', 'machine'])
            ->whereDate('started_at', today())
            ->get();

        return view('clinical.dialysis', compact('patients', 'machines', 'todaySessions'));
    }

    /**
     * Authorize Institutional Renal Patient Registration Protocol via Action
     */
    public function registerPatient(Request $request, RegisterRenalPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'access_type' => ['required', 'string', 'max:50'],
            'dry_weight' => ['required', 'numeric', 'min:0'],
            'frequency' => ['required', 'string', 'max:50'],
            'diagnosis' => ['required', 'string'],
        ]);

        $action->execute($validated);
        
        return redirect()->back()->with('success', 'Institutional renal patient registration protocol authorized.');
    }

    /**
     * Authorize Institutional Hemodialysis Session Initiation via Action
     */
    public function startSession(Request $request, \App\Actions\Clinical\StartDialysisSessionAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'dialysis_patient_id' => ['required', 'uuid', 'exists:dialysis_patients,id'],
            'machine_id' => ['required', 'uuid', 'exists:dialysis_machines,id'],
            'pre_weight' => ['required', 'numeric', 'min:0'],
            'uf_goal' => ['required', 'numeric', 'min:0'],
            'duration' => ['required', 'numeric', 'min:0'],
            'bfr' => ['required', 'numeric', 'min:0'],
            'dfr' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional hemodialysis session initiation authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Institutional Hemodialysis Session Protocol via Action
     */
    public function completeSession(Request $request, string $id, \App\Actions\Clinical\CompleteDialysisSessionAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'post_weight' => ['required', 'numeric', 'min:0'],
            'uf_achieved' => ['required', 'numeric', 'min:0'],
            'kt_v' => ['required', 'numeric', 'min:0'],
            'complications' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional hemodialysis session protocol finalized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Abort Institutional Dialysis Session Protocol via Action
     */
    public function abortSession(Request $request, string $id, \App\Actions\Clinical\AbortDialysisSessionAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => ['required', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional dialysis session protocol aborted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Intra-dialytic Vitals intelligence via Action
     */
    public function logVitals(Request $request, \App\Actions\Clinical\LogDialysisVitalsAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'session_id' => ['required', 'uuid', 'exists:dialysis_sessions,id'],
            'bp_systolic' => ['required', 'integer'],
            'bp_diastolic' => ['required', 'integer'],
            'heart_rate' => ['required', 'integer'],
            'temperature' => ['required', 'numeric'],
            'blood_flow' => ['required', 'integer'],
            'venous_pressure' => ['required', 'integer'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional intra-dialytic vitals intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update Institutional Renal Dry Weight Baseline via Action
     */
    public function updateDryWeight(Request $request, \App\Actions\Clinical\UpdateDialysisDryWeightAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'dialysis_patient_id' => ['required', 'uuid', 'exists:dialysis_patients,id'],
            'dry_weight' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional dry weight baseline updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Peritoneal Dialysis Record Protocol via Action
     */
    public function recordPD(Request $request, \App\Actions\Clinical\RecordPdSessionAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'dialysis_patient_id' => ['required', 'uuid', 'exists:dialysis_patients,id'],
            'fill_volume' => ['required', 'numeric'],
            'dwell_time' => ['required', 'numeric'],
            'drain_volume' => ['required', 'numeric'],
            'uf' => ['required', 'numeric'],
            'solution' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional peritoneal dialysis protocol committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Renal Laboratory intelligence via Action
     */
    public function recordLabs(Request $request, \App\Actions\Clinical\RecordRenalLabsAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'dialysis_patient_id' => ['required', 'uuid', 'exists:dialysis_patients,id'],
            'urea_pre' => ['required', 'numeric'],
            'urea_post' => ['required', 'numeric'],
            'creatinine' => ['required', 'numeric'],
            'potassium' => ['required', 'numeric'],
            'haemoglobin' => ['required', 'numeric'],
            'phosphate' => ['required', 'numeric'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional renal laboratory intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
