<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\NursingRound;
use App\Models\VitalsRecord;
use App\Helpers\Opeshis;
use Illuminate\Support\Str;

class NursingController extends Controller
{
    /**
     * Show Institutional Nursing Dashboard (Active Admitted Patients)
     */
    public function index()
    {
        $admissions = Admission::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->with(['patient', 'bed.ward'])
            ->where('status', 'admitted')
            ->get();

        $admissionIds = $admissions->pluck('id')->toArray();
        $vitals = VitalsRecord::whereIn('admission_id', $admissionIds)
            ->orderBy('recorded_at', 'desc')
            ->get()
            ->groupBy('admission_id');

        foreach ($admissions as $adm) {
            $adm->last_vitals = isset($vitals[$adm->id]) ? $vitals[$adm->id]->first() : null;
        }

        return view('nursing.index', compact('admissions'));
    }

    /**
     * Authorize Nursing Round (Vitals + Institutional Notes)
     */
    public function saveRound(Request $request)
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'notes' => 'nullable|string',
            'temp' => 'nullable|numeric',
            'pulse' => 'nullable|integer',
            'bp_sys' => 'nullable|integer',
            'bp_dia' => 'nullable|integer',
            'spo2' => 'nullable|numeric',
            'respiratory_rate' => 'nullable|integer',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function() use ($validated) {
            $round = NursingRound::create([
                'admission_id' => $validated['admission_id'],
                'staff_id' => auth()->id(),
                'scheduled_at' => now(),
                'completed_at' => now(),
                'task_type' => 'Full Institutional Assessment',
                'status' => 'completed',
                'notes' => $validated['notes'] ?? null
            ]);

            $news = \App\Services\NEWS2Service::calculate($validated);

            VitalsRecord::create([
                'admission_id' => $validated['admission_id'],
                'round_id' => $round->id,
                'temp' => $validated['temp'] ?? null,
                'pulse' => $validated['pulse'] ?? null,
                'bp_sys' => $validated['bp_sys'] ?? null,
                'bp_dia' => $validated['bp_dia'] ?? null,
                'spo2' => $validated['spo2'] ?? null,
                'respiratory_rate' => $validated['respiratory_rate'] ?? null,
                'news2_score' => $news['score'] ?? 0,
                'risk_level' => $news['risk_level'] ?? 'low',
                'recorded_by' => auth()->id(),
                'recorded_at' => now()
            ]);

            Opeshis::logAction(
                'NURSING_ROUND_RECORD',
                'nursing_rounds',
                $round->id,
                "Recorded vitals and clinical notes for admission: {$validated['admission_id']}"
            );
        });

        return redirect()->back()->with('success', 'Institutional nursing round recorded successfully.');
    }
}
