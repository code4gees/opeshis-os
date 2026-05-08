<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IsoCase;
use App\Models\IsoHaiRecord;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class IsolationController extends Controller
{
    /**
     * Institutional Infectious Disease Command Hub
     */
    public function index(): View
    {
        $isolations = IsoCase::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with(['patient'])
            ->where('status', 'active')
            ->get();

        return view('clinical.isolation', compact('isolations'));
    }

    /**
     * Authorize Institutional Isolation Precautions
     */
    public function place(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid'],
            'reason' => ['required', 'string'],
            'type' => ['required', 'string'],
            'room' => ['required', 'string'],
        ]);

        $isoCase = IsoCase::create([
            'patient_id' => $validated['patient_id'],
            'reason' => $validated['reason'],
            'isolation_type' => $validated['type'],
            'room_number' => $validated['room'],
            'status' => 'active',
            'placed_by' => auth()->id(),
            'placed_at' => now(),
        ]);

        Opeshis::logAction('ISO_PLACE', 'iso_cases', $isoCase->id, "Protocol: Isolation precautions activated ({$validated['type']}).");

        return redirect()->back()->with('success', 'Institutional isolation precautions activated.');
    }

    /**
     * Authorize Institutional Isolation Clearance Protocol
     */
    public function lift(Request $request, string $id): RedirectResponse
    {
        IsoCase::findOrFail($id)->update([
            'status' => 'lifted',
            'lifted_at' => now(),
            'lifted_by' => auth()->id(),
        ]);

        Opeshis::logAction('ISO_LIFT', 'iso_cases', $id, "Protocol: Isolation cleared.");

        return redirect()->back()->with('success', 'Institutional isolation clearance protocol authorized.');
    }

    /**
     * Commit Institutional HAI Intelligence
     */
    public function recordHAI(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid'],
            'infection_type' => ['required', 'string'],
            'organism' => ['required', 'string'],
        ]);

        IsoHaiRecord::create(array_merge($validated, ['recorded_by' => auth()->id()]));

        return redirect()->back()->with('success', 'Institutional HAI intelligence committed.');
    }

    /**
     * Authorize Institutional Outbreak Response Protocol
     */
    public function declareOutbreak(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'disease' => ['required', 'string'],
        ]);

        Opeshis::logAction('ISO_OUTBREAK', 'iso_cases', null, "CRITICAL: Outbreak detected - {$validated['disease']}. Surveillance notified.");

        return redirect()->back()->with('success', 'Institutional outbreak response protocol authorized. Surveillance units notified.');
    }
}
