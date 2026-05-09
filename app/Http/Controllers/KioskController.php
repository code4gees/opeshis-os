<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VitalsRecords;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KioskController extends Controller
{
    /**
     * Show Self-Service Triage Kiosk
     */
    public function triage(): View
    {
        return view('kiosk.triage');
    }

    /**
     * Submit Kiosk Vitals Protocol
     */
    public function submit(Request $request): RedirectResponse
    {
        $request->validate([
            'patient_id' => 'required', // Support UUID or Medical ID
            'bp_systolic' => 'nullable|numeric',
            'bp_diastolic' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'pulse' => 'nullable|numeric',
        ]);

        try {
            // Resolve Institutional Identity
            $patient = \App\Models\Patient::where('id', $request->patient_id)
                ->orWhere('medical_id', $request->patient_id)
                ->firstOrFail();

            // Institutional Vitals Mapping (Aligning with TriageController protocol)
            $vitals = [
                'temp' => $request->input('temperature'),
                'bp_sys' => $request->input('bp_systolic'),
                'bp_dia' => $request->input('bp_diastolic'),
                'pulse' => $request->input('pulse'),
                'weight' => $request->input('weight'),
                'source' => 'kiosk', // Telemetry tag
                'recorded_at' => now()->toIso8601String(),
            ];

            // Establish or Update Institutional Queue Entry
            \App\Models\ActiveQueue::updateOrCreate(
                [
                    'patient_id' => $patient->id,
                    'status' => 'waiting',
                ],
                [
                    'vitals_data' => $vitals,
                    'intent' => 'triage',
                    'is_nurse_validated' => false,
                ]
            );

            return redirect()->route('kiosk.triage')->with('success', 'Institutional vitals recorded. Please proceed to the clinical waiting area.');
        } catch (\Exception $e) {
            return redirect()->route('kiosk.triage')->with('error', 'Identification failure: ' . $e->getMessage());
        }
    }
}
