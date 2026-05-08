<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialtyRecord;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SpecialtyController extends Controller
{
    /**
     * Institutional Specialty Clinic Hub (Dental, Eye, ENT, Endoscopy)
     */
    public function index(string $type): View
    {
        $allowed = ['dental', 'eye', 'ent', 'endoscopy'];
        if (!in_array($type, $allowed)) {
            return abort(404);
        }

        $patients = SpecialtyRecord::with('patient')
            ->where('clinic_type', $type)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clinical.specialty', compact('patients', 'type'));
    }

    /**
     * Authorize Specialty Clinical Record Commitment
     */
    public function save(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid'],
            'clinic_type' => ['required', 'string'],
            'findings' => ['required', 'string'],
            'procedure' => ['nullable', 'string'],
        ]);

        SpecialtyRecord::create([
            'patient_id' => $validated['patient_id'],
            'clinic_type' => $validated['clinic_type'],
            'clinical_findings' => $validated['findings'],
            'procedure_done' => $validated['procedure'],
        ]);

        return redirect()->back()->with('success', 'Institutional ' . strtoupper($validated['clinic_type']) . ' protocol committed.');
    }
}
