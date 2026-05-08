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
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'bp_systolic' => 'nullable|numeric',
            'bp_diastolic' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'pulse' => 'nullable|numeric',
        ]);

        VitalsRecords::create([
            'patient_id' => $validated['patient_id'],
            'bp_systolic' => $validated['bp_systolic'],
            'bp_diastolic' => $validated['bp_diastolic'],
            'temperature' => $validated['temperature'],
            'weight' => $validated['weight'],
            'pulse' => $validated['pulse'],
            'recorded_by' => null, // Kiosk Mode
        ]);

        return redirect()->back()->with('success', 'Vitals recorded. Please proceed to the waiting area.');
    }
}
