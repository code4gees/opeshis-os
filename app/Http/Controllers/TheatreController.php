<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheatreCase;
use App\Models\TheatreIntraop;
use App\Models\TheatreVital;
use App\Models\TheatreAnaesthesiaDrug;
use App\Models\TheatreRecovery;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TheatreController extends Controller
{
    /**
     * Show Institutional Theatre Command Hub
     */
    public function index(): View
    {
        $list = TheatreCase::with(['patient', 'intraop'])
            ->orderBy('scheduled_date', 'asc')
            ->get();

        $todayList = $list->filter(fn($c) => \Carbon\Carbon::parse($c->scheduled_date)->isToday());

        $stats = [
            'today' => $todayList->count(),
            'pending_preop' => TheatreCase::where('preop_done', false)->count(),
            'in_progress' => TheatreCase::where('status', 'in_progress')->count()
        ];

        return view('clinical.theatre', compact('list', 'todayList', 'stats'));
    }

    /**
     * Authorize Institutional Pre-operative Assessment Protocol
     */
    public function savePreopAssessment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:theatre_cases,id'],
            'asa_grade' => ['required', 'integer'],
            'airway' => ['required', 'string'],
            'fasting' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        TheatreCase::findOrFail($validated['case_id'])->update([
            'asa_grade' => $validated['asa_grade'],
            'airway_assessment' => $validated['airway'],
            'fasting_status' => $validated['fasting'],
            'preop_notes' => $validated['notes'],
            'preop_done' => true,
            'preop_by' => auth()->id(),
            'preop_at' => now(),
        ]);

        Opeshis::logAction('THEATRE_PREOP', 'theatre_cases', $validated['case_id'], "Institutional Pre-op: ASA {$validated['asa_grade']}");

        return redirect()->back()->with('success', 'Institutional pre-operative assessment protocol authorized.');
    }

    /**
     * Authorize Institutional Intra-operative Procedure Initiation
     */
    public function startIntraop(Request $request, \App\Actions\Clinical\StartSurgicalProcedureAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:theatre_cases,id'],
            'anaesthesia_type' => ['required', 'string'],
            'surgeon_id' => ['required', 'uuid', 'exists:users,id'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional intra-operative record protocol initiated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Initiation failure: ' . $e->getMessage());
        }
    }

    /**
     * Finalize Institutional Intra-operative Procedure Protocol
     */
    public function completeIntraop(Request $request, \App\Actions\Clinical\CompleteSurgicalProcedureAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:theatre_cases,id'],
            'findings' => ['required', 'string'],
            'ebl' => ['required', 'numeric'],
            'specimens' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional intra-operative protocol finalized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Finalization failure: ' . $e->getMessage());
        }
    }

    /**
     * Commit Institutional Intra-operative Vital Signs Telemetry Protocol
     */
    public function logIntraopVitals(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:theatre_cases,id'],
            'bp_systolic' => ['required', 'integer'],
            'bp_diastolic' => ['required', 'integer'],
            'heart_rate' => ['required', 'integer'],
            'spo2' => ['required', 'integer'],
            'etco2' => ['nullable', 'integer'],
            'temperature' => ['nullable', 'numeric'],
        ]);

        TheatreVital::create(array_merge($validated, [
            'recorded_by' => auth()->id(),
        ]));

        return redirect()->back()->with('success', 'Institutional intra-operative vital telemetry committed.');
    }

    /**
     * Authorize Institutional Anaesthesia Drug Administration Protocol
     */
    public function logAnaesthesiaDrug(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:theatre_cases,id'],
            'drug' => ['required', 'string'],
            'dose' => ['required', 'string'],
            'route' => ['required', 'string'],
        ]);

        TheatreAnaesthesiaDrug::create([
            'case_id' => $validated['case_id'],
            'drug_name' => $validated['drug'],
            'dose' => $validated['dose'],
            'route' => $validated['route'],
            'administered_at' => now(),
            'administered_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional anaesthesia drug protocol authorized.');
    }

    /**
     * Authorize Institutional Recovery Unit Surveillance Initiation Protocol
     */
    public function saveRecovery(Request $request, \App\Actions\Clinical\LogSurgicalRecoveryAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:theatre_cases,id'],
            'aldrete' => ['required', 'integer'],
            'pain' => ['required', 'integer'],
            'nausea' => ['required', 'boolean'],
            'discharge_time' => ['nullable', 'date'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional recovery surveillance protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Recovery log failure: ' . $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Surgical Safety Checklist Protocol Verification
     */
    public function updateChecklist(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:theatre_cases,id'],
            'checklist' => ['required', 'array'],
        ]);

        TheatreCase::findOrFail($validated['case_id'])->update([
            'checklist' => $validated['checklist'],
            'checklist_verified_by' => auth()->id(),
            'checklist_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Institutional surgical safety checklist protocol verified.');
    }

    /**
     * Commit Institutional Recovery Unit Surveillance Update Protocol
     */
    public function updateRecovery(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        TheatreRecovery::findOrFail($id)->update([
            'current_status' => $validated['status'],
            'notes' => $validated['notes'],
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional recovery surveillance update committed.');
    }
}

