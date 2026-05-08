<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Opeshis;
use App\Models\OpdEncounter;
use App\Models\Patient;
use App\Models\LabOrder;
use App\Models\Prescription;
use App\Models\Admission;
use App\Models\ActiveQueue;

class ClinicalController extends Controller
{
    /**
     * Show the Universal EMR Engine (Consultation Interface)
     */
    public function emr(Request $request, $id = null)
    {
        $encounterId = $id ?? $request->query('queue_id', 0);

        // Fetch Encounter and Patient details via Institutional Eloquent
        $encounter = OpdEncounter::with('patient')->find($encounterId);

        if (!$encounter) {
            // If not found in encounters, check if it's a new encounter from the active_queue
            $queueItem = ActiveQueue::with('patient')->find($encounterId);

            if ($queueItem) {
                // Create a temporary encounter object for the view
                $encounter = (object) [
                    'id' => $queueItem->id,
                    'patient_id' => $queueItem->patient_id,
                    'full_name' => $queueItem->patient->full_name,
                    'medical_id' => $queueItem->patient->medical_id,
                    'gender' => $queueItem->patient->gender,
                    'date_of_birth' => $queueItem->patient->dob,
                    'blood_group' => $queueItem->patient->blood_group,
                    'genotype' => $queueItem->patient->genotype,
                    'allergies' => $queueItem->patient->allergies,
                    'created_at' => $queueItem->created_at,
                ];
                $consult = null;
            } else {
                return abort(404, 'Encounter Signal Lost: Entity Not Found');
            }
        } else {
            // Fetch Consultation Data via Relationship
            $consult = $encounter->consultation;
        }

        // Prepare JSON data (Eloquent handled casting)
        $icd10 = $consult ? ($consult->icd10_codes ?? []) : [];
        $prescriptions = $consult ? ($consult->prescriptions_json ?? []) : [];

        return view('emr', [
            'encounter' => $encounter,
            'consult' => $consult,
            'icd10' => $icd10,
            'prescriptions' => $prescriptions,
            'encounterId' => $encounterId
        ]);
    }

    /**
     * Save Consultation Data
     */
    public function saveConsultation(Request $request, \App\Actions\Clinical\SaveConsultationAction $action)
    {
        $request->validate([
            'encounter_id' => 'required',
            'subjective' => 'nullable|string',
            'objective' => 'nullable|string',
            'assessment' => 'nullable|string',
            'plan' => 'nullable|string',
        ]);

        try {
            $action->execute(new \App\DTOs\ConsultationDTO(
                encounterId: $request->input('encounter_id'),
                subjective: $request->input('subjective'),
                objective: $request->input('objective'),
                assessment: $request->input('assessment'),
                plan: $request->input('plan'),
                doctorId: (string) (auth()->id() ?? 'system')
            ));
            return redirect()->back()->with('success', 'Clinical documentation synchronized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Operational disruption: ' . $e->getMessage());
        }
    }

    /**
     * Close Consultation & Complete Flow
     */
    public function closeConsultation(Request $request, \App\Actions\Clinical\CloseConsultationAction $action)
    {
        try {
            $action->execute($request->input('encounter_id'));
            return redirect()->route('dashboard')->with('success', 'Consultation finalized. Patient flow completed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Operational disruption: ' . $e->getMessage());
        }
    }

    /**
     * Patient Longitudinal Dossier
     */
    public function dossier($id)
    {
        $patient = Patient::findOrFail($id);

        $encounters = OpdEncounter::with('doctor')
            ->where('patient_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $labs = LabOrder::where('patient_id', $id)->orderBy('created_at', 'desc')->get();
        $prescriptions = Prescription::where('patient_id', $id)->orderBy('created_at', 'desc')->get();
        $admissions = Admission::where('patient_id', $id)->orderBy('created_at', 'desc')->get();

        return view('clinical.dossier', compact('patient', 'encounters', 'labs', 'prescriptions', 'admissions'));
    }

    /**
     * Resolve Diagnostic Signal
     */
    public function resolveSignal(Request $request, $id, \App\Actions\Clinical\ResolveSignalAction $action)
    {
        $action->execute($request->input('type'), $id);
        return redirect()->back()->with('success', 'Diagnostic signal resolved and acknowledged.');
    }
}
