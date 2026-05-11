<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Opeshis;
use Illuminate\Support\Str;

class MaternalController extends Controller
{
    /**
     * Show Institutional Maternal Health Command
     */
    public function index()
    {
        $ancPatients = \App\Models\AncTracking::with(['patient', 'doctor'])
            ->when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->orderBy('edd_date', 'asc')
            ->get();

        $recentBirths = \App\Models\BirthRecord::with(['mother', 'clinician'])
            ->when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('mother', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->orderBy('birth_datetime', 'desc')
            ->limit(10)
            ->get();

        $activeAdmissions = \App\Models\Admission::where('admission_type', 'obstetrics')
            ->when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->with('patient')
            ->where('status', 'admitted')
            ->get();

        return view('maternal.index', compact('ancPatients', 'recentBirths', 'activeAdmissions'));
    }

    /**
     * Authorize Institutional Obstetric Admission Protocol via Action
     */
    public function admit(Request $request, \App\Actions\Clinical\AdmitObstetricsPatientAction $action)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'gravida' => ['required', 'integer'],
            'parity' => ['required', 'integer'],
            'gest_weeks' => ['required', 'integer'],
            'reason' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional obstetric admission protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Obstetric Observation Intelligence via Action
     */
    public function logObservation(Request $request, \App\Actions\Clinical\LogObstetricsObservationAction $action)
    {
        $validated = $request->validate([
            'admission_id' => ['required', 'uuid', 'exists:admissions,id'],
            'fhr' => ['required', 'integer'],
            'contractions' => ['required', 'string'],
            'dilation' => ['required', 'integer'],
            'notes' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional obstetric observation committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Register Patient for Institutional ANC Protocol
     */
    public function registerANC(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'lmp_date' => 'required|date',
            'gravida' => 'nullable|integer',
            'parity' => 'nullable|integer',
        ]);

        $lmp = \Carbon\Carbon::parse($request->input('lmp_date'));
        $edd = $lmp->copy()->addDays(280); // Naegele's rule approximation

        $anc = \App\Models\AncTracking::create([
            'patient_id' => $request->input('patient_id'),
            'doctor_id' => auth()->id(),
            'lmp_date' => $request->input('lmp_date'),
            'edd_date' => $edd->toDateString(),
            'gravida' => $request->input('gravida', 1),
            'parity' => $request->input('parity', 0),
        ]);

        Opeshis::logAction(
            'MATERNAL_ANC_REGISTER',
            'anc_tracking',
            $anc->id,
            "Registered patient for Institutional ANC tracking. EDD: " . $edd->toDateString()
        );

        return redirect()->back()->with('success', 'Patient registered for Institutional ANC program. EDD: ' . $edd->format('d M Y'));
    }

    /**
     * Record Institutional Birth Protocol
     */
    public function recordBirth(Request $request, \App\Actions\Clinical\RecordObstetricsDeliveryAction $action)
    {
        $validated = $request->validate([
            'admission_id' => ['required', 'uuid', 'exists:admissions,id'],
            'mode' => ['required', 'string'],
            'baby_weight' => ['required', 'numeric'],
            'apgar_1' => ['required', 'integer'],
            'apgar_5' => ['required', 'integer'],
            'complications' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional delivery record finalized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
