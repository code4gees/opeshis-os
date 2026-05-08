<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiometricEnrollment;
use App\Models\Patient;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class BiometricsController extends Controller
{
    public function index(): View
    {
        $enrollments = BiometricEnrollment::with('patient')->orderBy('created_at', 'desc')->get();
        return view('admin.biometrics', compact('enrollments'));
    }

    public function enroll(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'template' => 'required|string',
            'device_id' => 'nullable|string',
        ]);

        $bio = BiometricEnrollment::create([
            'patient_id' => $validated['patient_id'],
            'fingerprint_template' => $validated['template'],
            'device_id' => $validated['device_id'] ?? 'SYSTEM_BIO',
            'enrolled_by' => auth()->id(),
        ]);

        Opeshis::logAction('BIO_ENROLL', 'biometric_enrollments', $bio->id, "Institutional biometric enrollment authorized.");
        return redirect()->back()->with('success', 'Institutional biometric enrollment authorized.');
    }

    public function verify(Request $request): JsonResponse
    {
        $match = BiometricEnrollment::where('patient_id', $request->patient_id)->exists();
        return response()->json(['verified' => $match, 'patient_id' => $request->patient_id]);
    }
}
