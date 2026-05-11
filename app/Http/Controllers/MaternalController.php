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
            ->orderBy('edd_date', 'asc')
            ->get();

        $recentBirths = \App\Models\BirthRecord::with(['mother', 'clinician'])
            ->orderBy('birth_datetime', 'desc')
            ->limit(10)
            ->get();

        $activeAdmissions = \App\Models\Admission::where('admission_type', 'obstetrics')
            ->with('patient')
            ->where('status', 'admitted')
            ->get();

        return view('maternal.index', compact('ancPatients', 'recentBirths', 'activeAdmissions'));
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
    public function recordBirth(Request $request)
    {
        $request->validate([
            'mother_id' => 'required|uuid|exists:patients,id',
            'gender' => 'required|in:Male,Female,Indeterminate',
            'birth_datetime' => 'required|date',
            'weight' => 'required|numeric',
        ]);

        $birth = \App\Models\BirthRecord::create([
            'mother_id' => $request->input('mother_id'),
            'baby_name' => $request->input('baby_name'),
            'gender' => $request->input('gender'),
            'birth_datetime' => $request->input('birth_datetime'),
            'weight_kg' => $request->input('weight'),
            'delivery_type' => $request->input('delivery_type', 'Normal Vaginal'),
            'attending_clinician_id' => auth()->id(),
        ]);

        Opeshis::logAction(
            'MATERNAL_BIRTH_RECORD',
            'birth_records',
            $birth->id,
            "Recorded Institutional birth of baby: " . ($request->input('baby_name') ?: 'Unknown')
        );

        return redirect()->back()->with('success', 'Birth record finalized in Institutional Maternal registry.');
    }
}
