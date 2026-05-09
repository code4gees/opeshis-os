<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EyePatient;
use App\Models\EyeExamination;
use App\Models\EyeRefraction;
use App\Models\EyeIopReading;
use App\Models\EyeSurgery;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EyeController extends Controller
{
    /**
     * Show Institutional Ophthalmology Command Hub
     */
    public function index(): View
    {
        $patients = EyePatient::with(['patient'])
            ->orderBy('created_at', 'desc')
            ->get();

        $surgicalList = EyeSurgery::with(['eyePatient.patient'])
            ->where('status', 'planned')
            ->get();

        return view('clinical.eye', compact('patients', 'surgicalList'));
    }

    /**
     * Authorize Institutional Eye Registry Enrollment
     */
    public function registerPatient(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'complaint' => ['required', 'string'],
        ]);

        try {
            // Resolve Identity
            $patient = \App\Models\Patient::where('id', $validated['patient_id'])
                ->orWhere('medical_id', $validated['patient_id'])
                ->firstOrFail();

            $eyePatient = EyePatient::create([
                'patient_id' => $patient->id,
                'chief_complaint' => $validated['complaint'],
                'registered_by' => auth()->id(),
            ]);

            Opeshis::logAction('EYE_REGISTER', 'eye_patients', $eyePatient->id, 'Institutional Eye Enrollment authorized.');

            return redirect()->route('specialty.clinics.eye.index')->with('success', 'Institutional eye registry enrollment authorized.');
        } catch (\Exception $e) {
            return redirect()->route('specialty.clinics.eye.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Eye Examination Intelligence
     */
    public function recordExamination(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'eye_patient_id' => ['required', 'uuid', 'exists:eye_patients,id'],
            'va_right' => ['required', 'string'],
            'va_left' => ['required', 'string'],
            'iop_right' => ['nullable', 'numeric'],
            'iop_left' => ['nullable', 'numeric'],
            'diagnosis' => ['required', 'string'],
            'plan' => ['required', 'string'],
        ]);

        EyeExamination::create([
            'eye_patient_id' => $validated['eye_patient_id'],
            'va_right' => $validated['va_right'],
            'va_left' => $validated['va_left'],
            'iop_right' => $validated['iop_right'],
            'iop_left' => $validated['iop_left'],
            'diagnosis' => $validated['diagnosis'],
            'plan' => $validated['plan'],
            'recorded_by' => auth()->id(),
        ]);

        Opeshis::logAction('EYE_EXAM', 'eye_examinations', $validated['eye_patient_id'], "Institutional Eye Examination intelligence committed.");

        return redirect()->route('specialty.clinics.eye.index')->with('success', 'Institutional eye examination intelligence committed.');
    }

    /**
     * Commit Institutional Eye Refraction Intelligence
     */
    public function recordRefraction(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'eye_patient_id' => ['required', 'uuid', 'exists:eye_patients,id'],
            'sphere_right' => ['required', 'numeric'],
            'cylinder_right' => ['nullable', 'numeric'],
            'axis_right' => ['nullable', 'numeric'],
            'sphere_left' => ['required', 'numeric'],
            'cylinder_left' => ['nullable', 'numeric'],
            'axis_left' => ['nullable', 'numeric'],
        ]);

        EyeRefraction::create([
            'eye_patient_id' => $validated['eye_patient_id'],
            'sphere_right' => $validated['sphere_right'],
            'cylinder_right' => $validated['cylinder_right'],
            'axis_right' => $validated['axis_right'],
            'sphere_left' => $validated['sphere_left'],
            'cylinder_left' => $validated['cylinder_left'],
            'axis_left' => $validated['axis_left'],
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->route('specialty.clinics.eye.index')->with('success', 'Institutional eye refraction intelligence committed.');
    }

    /**
     * Commit Institutional IOP Monitoring Intelligence
     */
    public function logIOP(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'eye_patient_id' => ['required', 'uuid', 'exists:eye_patients,id'],
            'iop_right' => ['required', 'numeric'],
            'iop_left' => ['required', 'numeric'],
            'method' => ['required', 'string'],
        ]);

        EyeIopReading::create([
            'eye_patient_id' => $validated['eye_patient_id'],
            'iop_right' => $validated['iop_right'],
            'iop_left' => $validated['iop_left'],
            'method' => $validated['method'],
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->route('specialty.clinics.eye.index')->with('success', 'Institutional IOP monitoring intelligence committed.');
    }

    /**
     * Authorize Institutional Eye Surgery Protocol
     */
    public function planSurgery(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'eye_patient_id' => ['required', 'uuid', 'exists:eye_patients,id'],
            'procedure' => ['required', 'string'],
            'eye_side' => ['required', 'string'],
            'scheduled_date' => ['required', 'date'],
        ]);

        $surgery = EyeSurgery::create([
            'eye_patient_id' => $validated['eye_patient_id'],
            'procedure' => $validated['procedure'],
            'eye_side' => $validated['eye_side'],
            'scheduled_date' => $validated['scheduled_date'],
            'status' => 'planned',
            'surgeon_id' => auth()->id(),
        ]);

        Opeshis::logAction('EYE_SURGERY_PLAN', 'eye_surgeries', $surgery->id, "Institutional Eye Surgery Protocol authorized: {$validated['procedure']}");

        return redirect()->route('specialty.clinics.eye.index')->with('success', 'Institutional eye surgery protocol authorized.');
    }

    /**
     * Commit Institutional Eye Surgery Completion Intelligence
     */
    public function completeSurgery(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'notes' => ['required', 'string'],
        ]);

        EyeSurgery::findOrFail($id)->update([
            'status' => 'completed',
            'operative_notes' => $validated['notes'],
            'completed_at' => now(),
        ]);

        Opeshis::logAction('EYE_SURGERY_COMPLETE', 'eye_surgeries', $id, "Institutional Eye Surgery Outcome finalized.");

        return redirect()->route('specialty.clinics.eye.index')->with('success', 'Institutional eye surgery completion intelligence committed.');
    }
}

