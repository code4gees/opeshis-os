<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MalariaCase;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MalariaController extends Controller
{
    /**
     * Institutional Malaria Surveillance Matrix
     */
    public function index(): View
    {
        $cases = MalariaCase::with('patient')->orderBy('created_at', 'desc')->get();

        return view('clinical.malaria', compact('cases'));
    }

    /**
     * Register Institutional Malaria Case Protocol
     */
    public function registerCase(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'species' => 'required|string',
            'test_type' => 'required|string',
            'result' => 'required|string',
            'treatment' => 'required|string',
        ]);

        $case = MalariaCase::create([
            'patient_id' => $validated['patient_id'],
            'species' => $validated['species'],
            'test_type' => $validated['test_type'],
            'result' => $validated['result'],
            'treatment_given' => $validated['treatment'],
            'registered_by' => auth()->id(),
        ]);

        Opeshis::logAction('MALARIA_REGISTER', 'malaria_cases', $case->id, "Malaria case registered: {$validated['species']}.");
        
        return redirect()->back()->with('success', 'Institutional malaria case registered and surveillance notified.');
    }
}
