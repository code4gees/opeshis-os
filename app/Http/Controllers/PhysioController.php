<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhysioCase;
use App\Models\PhysioAssessment;
use App\Models\PhysioSession;
use App\Actions\Clinical\RegisterPhysioCaseAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PhysioController extends Controller
{
    /**
     * Show Institutional Physiotherapy Command Hub
     */
    public function index(): View
    {
        $cases = PhysioCase::with(['patient'])
            ->withCount('sessions')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clinical.physio', compact('cases'));
    }

    /**
     * Authorize Institutional Physiotherapy Case Registration Protocol via Action
     */
    public function registerCase(Request $request, RegisterPhysioCaseAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'diagnosis' => ['required', 'string'],
            'source' => ['required', 'string'],
            'goals' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional physiotherapy case protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Clinical Physiotherapy Assessment Intelligence via Action
     */
    public function recordAssessment(Request $request, \App\Actions\Clinical\RecordPhysioAssessmentAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:physio_cases,id'],
            'subjective' => ['required', 'string'],
            'objective' => ['required', 'string'],
            'assessment' => ['required', 'string'],
            'plan' => ['required', 'string'],
            'rom' => ['nullable', 'string'],
            'strength' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional clinical assessment intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Therapy Session Performance Protocol via Action
     */
    public function recordSession(Request $request, \App\Actions\Clinical\RecordPhysioSessionAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:physio_cases,id'],
            'interventions' => ['required', 'string'],
            'duration' => ['required', 'integer'],
            'response' => ['nullable', 'string'],
            'home_exercise' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional therapy session performance protocol committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Institutional Rehabilitation Outcome Protocol via Action
     */
    public function recordOutcome(Request $request, \App\Actions\Clinical\RecordPhysioOutcomeAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:physio_cases,id'],
            'outcome' => ['required', 'string'],
            'achieved' => ['required', 'boolean'],
        ]);

        try {
            $action->execute($validated['case_id'], $validated);
            return redirect()->back()->with('success', 'Institutional rehabilitation outcome finalized. Case protocol closed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
