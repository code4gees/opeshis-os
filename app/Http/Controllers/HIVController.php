<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HivEnrollment;
use App\Models\Patient;
use App\Services\HIVService;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HIVController extends Controller
{
    /**
     * Institutional HIV/ART Clinic Dashboard
     */
    public function index(): View
    {
        $metrics = HIVService::get959595Metrics();

        $enrollments = HivEnrollment::with([
                'patient',
                'currentRegimen',
                'latestViralLoad',
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($enrollments as $e) {
            if ($e->patient) {
                $e->patient->full_name = Opeshis::decryptPII($e->patient->full_name);
                $e->age = \Carbon\Carbon::parse($e->patient->dob)->age;
            }
            $e->art_number = $e->unique_art_number;
            $e->who_stage = $e->who_clinical_stage;
        }

        return view('clinical.hiv', compact('metrics', 'enrollments'));
    }

    /**
     * Authorize Institutional ART Enrollment Protocol
     */
    public function enroll(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'art_number' => 'required|string',
            'who_stage' => 'required|string',
        ]);

        $enrollment = HivEnrollment::create([
            'patient_id' => $validated['patient_id'],
            'unique_art_number' => $validated['art_number'],
            'enrollment_date' => now(),
            'who_clinical_stage' => $validated['who_stage'],
            'status' => 'active',
            'created_by' => auth()->id(),
        ]);

        Opeshis::logAction('HIV_ENROLL', 'hiv_enrollments', $enrollment->id, "Protocol: ART enrollment #{$validated['art_number']}.");

        return redirect()->back()->with('success', 'Patient enrolled successfully in ART program.');
    }

    /**
     * Authorize Institutional ART Regimen Transition
     */
    public function changeRegimen(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|uuid|exists:hiv_enrollments,id',
            'regimen_code' => 'required|string',
            'regimen_line' => 'required|string',
            'reason' => 'required|string',
        ]);

        HIVService::changeRegimen($validated['enrollment_id'], [
            'code' => $validated['regimen_code'],
            'line' => $validated['regimen_line'],
            'reason' => $validated['reason'],
        ]);

        Opeshis::logAction('HIV_REGIMEN_CHANGE', 'hiv_art_regimens', $validated['enrollment_id'], "Protocol: Switched to {$validated['regimen_code']}.");

        return redirect()->back()->with('success', 'Institutional regimen transition authorized.');
    }
}
