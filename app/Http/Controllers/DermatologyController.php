<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DermPatient;
use App\Models\DermConsultation;
use App\Actions\Clinical\RegisterDermPatientAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DermatologyController extends Controller
{
    /**
     * Show Institutional Dermatology Command Hub
     */
    public function index(): View
    {
        $patients = DermPatient::with(['patient'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clinical.dermatology', compact('patients'));
    }

    /**
     * Authorize Institutional Dermatology Registration Protocol via Action
     */
    public function register(Request $request, RegisterDermPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'diagnosis' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional dermatology registration protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Dermatology Consultation Intelligence
     */
    public function recordConsultation(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'derm_patient_id' => ['required', 'uuid', 'exists:derm_patients,id'],
            'findings' => ['required', 'string'],
            'body_area' => ['required', 'string'],
            'treatment' => ['required', 'string'],
        ]);

        DermConsultation::create([
            'derm_patient_id' => $validated['derm_patient_id'],
            'skin_findings' => $validated['findings'],
            'body_area' => $validated['body_area'],
            'treatment' => $validated['treatment'],
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional dermatology consultation intelligence committed.');
    }
}
