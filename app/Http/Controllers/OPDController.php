<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpdEncounter;
use App\Models\OpdConsultation;
use App\Models\Patient;
use App\Helpers\Opeshis;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OPDController extends Controller
{
    /**
     * Show Institutional OPD Command Hub
     */
    public function index(): View
    {
        $queue = OpdEncounter::with(['patient', 'doctor'])
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'asc')
            ->get();

        $stats = [
            'today' => $queue->count(),
            'seen' => $queue->where('status', 'completed')->count(),
            'waiting' => $queue->where('status', 'waiting')->count()
        ];

        return view('clinical.opd', compact('queue', 'stats'));
    }

    /**
     * Authorize Institutional OPD Encounter Registration Protocol
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'department' => ['required', 'string'],
            'visit_type' => ['required', 'string'],
            'complaint' => ['nullable', 'string'],
        ]);

        $encounterNumber = 'OPD-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $encounter = OpdEncounter::create([
            'patient_id' => $validated['patient_id'],
            'encounter_number' => $encounterNumber,
            'status' => 'waiting',
            'branch_id' => auth()->user()->branch_id ?? null,
        ]);

        // Forensic: Log registration
        Opeshis::logAction('OPD_REGISTER', 'opd_encounters', $encounter->id, "Institutional OPD Encounter authorized: {$encounterNumber}");

        return redirect()->route('clinical.opd.index')->with('success', "Institutional OPD encounter registered: {$encounterNumber}");
    }

    /**
     * Commit Institutional Clinical Consultation Intelligence Protocol
     */
    public function consult(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'visit_id' => ['required', 'integer', 'exists:opd_encounters,id'],
            'history' => ['required', 'string'],
            'examination' => ['required', 'string'],
            'impression' => ['required', 'string'],
            'plan' => ['required', 'string'],
        ]);

        $encounter = OpdEncounter::findOrFail($validated['visit_id']);
        $encounter->update([
            'status' => 'in_progress',
            'assigned_doctor_id' => auth()->id(),
        ]);

        $consultation = OpdConsultation::create([
            'encounter_id' => $encounter->id,
            'subjective' => $validated['history'],
            'objective' => $validated['examination'],
            'assessment' => $validated['impression'],
            'plan' => $validated['plan'],
            'branch_id' => auth()->user()->branch_id ?? null,
        ]);

        Opeshis::logAction('OPD_CONSULT', 'opd_consultations', $consultation->id, "Institutional Clinical Consultation intelligence committed.");

        return redirect()->route('clinical.opd.index')->with('success', 'Institutional clinical consultation intelligence recorded.');
    }

    /**
     * Finalize Institutional OPD Discharge Protocol
     */
    public function discharge(Request $request, string $id): RedirectResponse
    {
        $encounter = OpdEncounter::findOrFail($id);
        $encounter->update([
            'status' => 'completed',
        ]);

        Opeshis::logAction('OPD_DISCHARGE', 'opd_encounters', $id, "Institutional OPD Discharge Protocol finalized.");

        return redirect()->route('clinical.opd.index')->with('success', 'Patient institutional discharge finalized.');
    }
}
