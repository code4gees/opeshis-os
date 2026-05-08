<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PftSession;
use App\Models\PftMeasurement;
use App\Models\PftReversibility;
use App\Actions\Clinical\CreatePftSessionAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class PFTController extends Controller
{
    /**
     * Institutional Respiratory Intelligence Hub
     */
    public function index(): View
    {
        $sessions = PftSession::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with(['patient', 'measurement', 'reversibility'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clinical.pft', compact('sessions'));
    }

    /**
     * Authorize Institutional PFT Session via Action
     */
    public function createSession(Request $request, CreatePftSessionAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'indication' => ['required', 'string'],
        ]);

        $action->execute($validated);

        return redirect()->back()->with('success', 'Institutional PFT session authorized and initialized.');
    }

    /**
     * Commit Institutional PFT Spirometry Measurements via Action
     */
    public function saveMeasurements(Request $request, \App\Actions\Clinical\RecordPftMeasurementAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'session_id' => ['required', 'uuid', 'exists:pft_sessions,id'],
            'fvc' => ['required', 'numeric'],
            'fev1' => ['required', 'numeric'],
            'pef' => ['required', 'numeric'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional PFT spirometry measurements committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional PFT Reversibility Intelligence via Action
     */
    public function saveReversibility(Request $request, \App\Actions\Clinical\RecordPftReversibilityAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'session_id' => ['required', 'uuid', 'exists:pft_sessions,id'],
            'post_fev1' => ['required', 'numeric'],
            'post_fvc' => ['required', 'numeric'],
            'reversibility' => ['required', 'numeric'],
            'significant' => ['required', 'boolean'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional PFT reversibility intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional PFT Clinical Interpretation via Action
     */
    public function saveReport(Request $request, \App\Actions\Clinical\FinalizePftReportAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'session_id' => ['required', 'uuid', 'exists:pft_sessions,id'],
            'interpretation' => ['required', 'string'],
            'recommendation' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated['session_id'], $validated);
            return redirect()->back()->with('success', 'Institutional PFT clinical report committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Fetch Institutional Patient Respiratory Trends
     */
    public function getPatientTrend(string $patientId): JsonResponse
    {
        $sessions = PftSession::with(['measurement'])
            ->where('patient_id', $patientId)
            ->whereHas('measurement')
            ->orderBy('created_at')
            ->get()
            ->map(function ($s) {
                return [
                    'created_at' => $s->created_at,
                    'fvc' => $s->measurement->fvc,
                    'fev1' => $s->measurement->fev1,
                    'fev1_fvc_ratio' => $s->measurement->fev1_fvc_ratio,
                    'pef' => $s->measurement->pef,
                ];
            });

        return response()->json($sessions);
    }
}
