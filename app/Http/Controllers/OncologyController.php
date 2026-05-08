<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OncoRegistry;
use App\Models\OncoTreatmentPlan;
use App\Models\OncoProtocol;
use App\Models\OncoDrugAdmin;
use App\Models\OncoCycle;
use App\Models\OncoFollowup;
use App\Models\OncoNursingAssessment;
use App\Actions\Clinical\RegisterOncoDiagnosisAction;
use App\Actions\Clinical\CreateOncoTreatmentPlanAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class OncologyController extends Controller
{
    /**
     * Show Institutional Oncology Command Center
     */
    public function index(): View
    {
        $patients = OncoRegistry::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with(['patient', 'activePlan'])
            ->orderBy('created_at', 'desc')
            ->get();

        $protocols = OncoProtocol::orderBy('name')->get();

        return view('clinical.oncology', compact('patients', 'protocols'));
    }

    /**
     * Authorize Institutional Cancer Diagnosis Enrollment Protocol via Action
     */
    public function registerDiagnosis(Request $request, RegisterOncoDiagnosisAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'type' => ['required', 'string'],
            'icd' => ['required', 'string'],
            'stage' => ['required', 'string'],
            'histology' => ['required', 'string'],
            'diagnosis_date' => ['required', 'date'],
        ]);

        $action->execute($validated);

        return redirect()->back()->with('success', 'Institutional cancer diagnosis enrollment authorized.');
    }

    /**
     * Authorize Institutional Chemotherapy Treatment Plan Protocol via Action
     */
    public function createPlan(Request $request, CreateOncoTreatmentPlanAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'onco_patient_id' => ['required', 'uuid', 'exists:onco_registry,id'],
            'protocol_id' => ['required', 'uuid', 'exists:onco_protocols,id'],
            'intent' => ['required', 'string'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'cycles' => ['required', 'integer'],
        ]);

        $action->execute($validated);

        return redirect()->back()->with('success', 'Institutional chemotherapy treatment protocol authorized.');
    }

    /**
     * Commit Institutional Oncology Drug Administration Protocol via Action
     */
    public function logDrugAdmin(Request $request, \App\Actions\Clinical\LogOncoDrugAdminAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'plan_id' => ['required', 'uuid', 'exists:onco_treatment_plans,id'],
            'drug' => ['required', 'string'],
            'dose' => ['required', 'numeric'],
            'unit' => ['required', 'string'],
            'route' => ['required', 'string'],
            'cycle' => ['required', 'integer'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Therapeutic drug administration committed to institutional record.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Institutional BSA Calculation Matrix
     */
    public function calculateBSA(Request $request): JsonResponse
    {
        $bsa = ($request->weight && $request->height) 
            ? round(sqrt(($request->height * $request->weight) / 3600), 2) 
            : 0;

        return response()->json(['bsa' => $bsa]);
    }

    /**
     * Schedule Institutional Chemotherapy Treatment Cycle via Action
     */
    public function scheduleCycle(Request $request, \App\Actions\Clinical\ScheduleOncoCycleAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'plan_id' => ['required', 'uuid', 'exists:onco_treatment_plans,id'],
            'cycle_number' => ['required', 'integer'],
            'date' => ['required', 'date'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional treatment cycle scheduled.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Institutional Chemotherapy Treatment Cycle Protocol via Action
     */
    public function completeCycle(Request $request, string $id, \App\Actions\Clinical\CompleteOncoCycleAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'toxicity' => ['required', 'integer'],
            'notes' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional treatment cycle protocol finalized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Treatment Cycle Clearance Protocol via Action
     */
    public function clearCycle(Request $request, string $id, \App\Actions\Clinical\ClearOncoCycleAction $action): RedirectResponse
    {
        try {
            $action->execute($id);
            return redirect()->back()->with('success', 'Institutional cycle clearance authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Schedule Institutional Oncology Follow-up Surveillance via Action
     */
    public function scheduleFollowup(Request $request, \App\Actions\Clinical\ScheduleOncoFollowupAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'onco_patient_id' => ['required', 'uuid', 'exists:onco_registry,id'],
            'date' => ['required', 'date'],
            'type' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional follow-up surveillance scheduled.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Oncology Follow-up Findings Protocol via Action
     */
    public function completeFollowup(Request $request, string $id, \App\Actions\Clinical\CompleteOncoFollowupAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'findings' => ['required', 'string'],
            'plan' => ['required', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional follow-up clinical findings committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Nursing Oncology Assessment Protocol via Action
     */
    public function logNursingAssessment(Request $request, \App\Actions\Clinical\LogOncoNursingAssessmentAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'plan_id' => ['required', 'uuid', 'exists:onco_treatment_plans,id'],
            'ecog' => ['required', 'integer'],
            'pain' => ['required', 'integer'],
            'nausea' => ['required', 'integer'],
            'fatigue' => ['required', 'integer'],
            'notes' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional nursing oncology assessment committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Fetch Institutional Oncology Protocols Registry
     */
    public function getProtocols(): JsonResponse
    {
        return response()->json(OncoProtocol::orderBy('name')->get());
    }
}
