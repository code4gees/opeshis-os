<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NCDRegistry;
use App\Models\NCDMetric;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class NCDController extends Controller
{
    /**
     * Show Institutional NCD & Chronic Care Hub
     */
    public function index(): View
    {
        $registry = NCDRegistry::with(['patient'])
            ->where('status', 'active')
            ->get();

        foreach ($registry as $r) {
            $r->last_seen = NCDMetric::where('patient_id', $r->patient_id)
                ->orderBy('measured_at', 'desc')
                ->value('measured_at');
        }

        return view('ncd.index', compact('registry'));
    }

    /**
     * Authorize Institutional Chronic Care Enrollment Protocol
     */
    public function enroll(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'condition' => ['required', 'string'],
        ]);

        $enrollment = NCDRegistry::create([
            'patient_id' => $validated['patient_id'],
            'condition_type' => $validated['condition'],
            'enrolled_by' => auth()->id(),
            'status' => 'active',
        ]);

        Opeshis::logAction('NCD_ENROLL', 'ncd_registry', $enrollment->id, "Institutional Chronic Care Enrollment authorized: {$validated['condition']}");

        return redirect()->back()->with('success', 'Patient enrolled in Institutional Chronic Care Registry.');
    }

    /**
     * Commit Institutional Clinical Metric Protocol
     */
    public function logMetric(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'type' => ['required', 'string'],
            'value' => ['required', 'string'],
            'unit' => ['required', 'string'],
        ]);

        NCDMetric::create([
            'patient_id' => $validated['patient_id'],
            'metric_type' => $validated['type'],
            'metric_value' => $validated['value'],
            'metric_unit' => $validated['unit'],
            'noted_by' => auth()->id(),
            'measured_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Institutional clinical metric committed.']);
    }

    /**
     * Show Institutional Clinical Trends Protocol
     */
    public function getTrends(string $patientId): JsonResponse
    {
        $data = NCDMetric::where('patient_id', $patientId)
            ->where('metric_type', 'BP')
            ->orderBy('measured_at', 'asc')
            ->get();
        
        return response()->json(['success' => true, 'data' => $data]);
    }
}
