<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsentTemplates;
use App\Models\PatientConsents;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ConsentController extends Controller
{
    /**
     * Institutional Consent Registry Hub
     */
    public function index(): View
    {
        $templates = ConsentTemplates::orderBy('category')->get();
        
        $recentConsents = PatientConsents::with('patient')
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        return view('clinical.consent', compact('templates', 'recentConsents'));
    }

    /**
     * Retrieve Institutional Consent Templates
     */
    public function getTemplates(): JsonResponse
    {
        return response()->json(ConsentTemplates::orderBy('category')->get());
    }

    /**
     * Authorize Institutional Informed Consent Protocol
     */
    public function save(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'template_id' => 'required|uuid|exists:consent_templates,id',
            'witness' => 'nullable|string',
            'guardian' => 'nullable|string',
            'signature' => 'required|string',
        ]);

        $consent = PatientConsents::create([
            'patient_id' => $validated['patient_id'],
            'template_id' => $validated['template_id'],
            'signed_by_patient' => (bool)$request->input('signed'),
            'witness_name' => $validated['witness'],
            'guardian_name' => $validated['guardian'],
            'signature_data' => $validated['signature'],
            'obtained_by' => auth()->id(),
        ]);

        Opeshis::logAction('CONSENT_SAVE', 'patient_consents', $consent->id, "Protocol: Informed consent obtained and authorized.");
        
        return redirect()->back()->with('success', 'Institutional informed consent recorded.');
    }
}
