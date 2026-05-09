<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\ObstetricsObservation;
use App\Models\ObstetricsDelivery;
use App\Actions\Clinical\AdmitObstetricsPatientAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ObstetricsController extends Controller
{
    /**
     * Institutional Obstetric Census Command Hub
     */
    public function index(): View
    {
        $census = Admission::where('admission_type', 'obstetrics')
            ->when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->with(['patient', 'observations'])
            ->where('status', 'admitted')
            ->orderBy('admission_date', 'desc')
            ->get();

        return view('clinical.obstetrics', compact('census'));
    }

    /**
     * Authorize Institutional Obstetric Admission Protocol via Action
     */
    public function admit(Request $request, AdmitObstetricsPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid'],
            'patient_id' => ['required', 'string'],
            'gravida' => ['required', 'integer'],
            'parity' => ['required', 'integer'],
            'gest_weeks' => ['required', 'integer'],
            'reason' => ['required', 'string'],
        ]);

        try {
            // Resolve Identity
            $patient = \App\Models\Patient::where('id', $validated['patient_id'])
                ->orWhere('medical_id', $validated['patient_id'])
                ->firstOrFail();
            $validated['patient_id'] = $patient->id;

            $action->execute($validated);
            return redirect()->route('clinical.obstetrics.index')->with('success', 'Institutional obstetric admission protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->route('clinical.obstetrics.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Obstetric Observation Intelligence via Action
     */
    public function logObservation(Request $request, \App\Actions\Clinical\LogObstetricsObservationAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => ['required', 'uuid'],
            'fhr' => ['required', 'integer'],
            'contractions' => ['required', 'string'],
            'dilation' => ['required', 'integer'],
            'presentation' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('clinical.obstetrics.index')->with('success', 'Institutional obstetric observation intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->route('clinical.obstetrics.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Institutional Delivery Protocol Intelligence via Action
     */
    public function recordDelivery(Request $request, \App\Actions\Clinical\RecordObstetricsDeliveryAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => ['required', 'uuid'],
            'mode' => ['required', 'string'],
            'baby_weight' => ['required', 'numeric'],
            'apgar_1' => ['required', 'integer'],
            'apgar_5' => ['required', 'integer'],
            'complications' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('clinical.obstetrics.index')->with('success', 'Institutional delivery protocol intelligence finalized.');
        } catch (\Exception $e) {
            return redirect()->route('clinical.obstetrics.index')->with('error', $e->getMessage());
        }
    }
}
