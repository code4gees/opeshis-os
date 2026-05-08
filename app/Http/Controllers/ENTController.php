<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntPatient;
use App\Models\EntExamination;
use App\Models\EntAudiogram;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ENTController extends Controller
{
    /**
     * Show Institutional Otolaryngology Command Hub
     */
    public function index(): View
    {
        $patients = EntPatient::with(['patient'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clinical.ent', compact('patients'));
    }

    /**
     * Authorize Institutional ENT Registry Enrollment
     */
    public function registerPatient(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'complaint' => ['required', 'string'],
        ]);

        $entPatient = EntPatient::create([
            'patient_id' => $validated['patient_id'],
            'chief_complaint' => $validated['complaint'],
            'registered_by' => auth()->id(),
        ]);

        Opeshis::logAction('ENT_REGISTER', 'ent_patients', $entPatient->id, 'Institutional ENT Enrollment authorized.');

        return redirect()->back()->with('success', 'Institutional ENT registry enrollment authorized.');
    }

    /**
     * Commit Institutional ENT Examination Intelligence
     */
    public function recordExamination(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ent_patient_id' => ['required', 'uuid', 'exists:ent_patients,id'],
            'ear_findings' => ['nullable', 'string'],
            'nose_findings' => ['nullable', 'string'],
            'throat_findings' => ['nullable', 'string'],
            'diagnosis' => ['required', 'string'],
            'plan' => ['required', 'string'],
        ]);

        $examination = EntExamination::create([
            'ent_patient_id' => $validated['ent_patient_id'],
            'ear_findings' => $validated['ear_findings'],
            'nose_findings' => $validated['nose_findings'],
            'throat_findings' => $validated['throat_findings'],
            'diagnosis' => $validated['diagnosis'],
            'plan' => $validated['plan'],
            'recorded_by' => auth()->id(),
        ]);

        Opeshis::logAction('ENT_EXAM', 'ent_examinations', $examination->id, "Institutional ENT Examination intelligence committed.");

        return redirect()->back()->with('success', 'Institutional ENT examination intelligence committed.');
    }

    /**
     * Commit Institutional Audiological Telemetry Intelligence
     */
    public function recordAudiogram(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ent_patient_id' => ['required', 'uuid', 'exists:ent_patients,id'],
            'right_500' => ['required', 'numeric'],
            'right_1k' => ['required', 'numeric'],
            'right_2k' => ['required', 'numeric'],
            'right_4k' => ['required', 'numeric'],
            'left_500' => ['required', 'numeric'],
            'left_1k' => ['required', 'numeric'],
            'left_2k' => ['required', 'numeric'],
            'left_4k' => ['required', 'numeric'],
            'interpretation' => ['required', 'string'],
        ]);

        $audiogram = EntAudiogram::create([
            'ent_patient_id' => $validated['ent_patient_id'],
            'right_ear_500hz' => $validated['right_500'],
            'right_ear_1khz' => $validated['right_1k'],
            'right_ear_2khz' => $validated['right_2k'],
            'right_ear_4khz' => $validated['right_4k'],
            'left_ear_500hz' => $validated['left_500'],
            'left_ear_1khz' => $validated['left_1k'],
            'left_ear_2khz' => $validated['left_2k'],
            'left_ear_4khz' => $validated['left_4k'],
            'interpretation' => $validated['interpretation'],
            'recorded_by' => auth()->id(),
        ]);

        Opeshis::logAction('ENT_AUDIOGRAM', 'ent_audiograms', $audiogram->id, "Institutional Audiological Telemetry committed.");

        return redirect()->back()->with('success', 'Institutional audiological telemetry intelligence committed.');
    }
}

