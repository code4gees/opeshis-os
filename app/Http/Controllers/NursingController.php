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
        $admissions = Admission::with(['patient', 'bed.ward'])
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
        $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'notes' => 'nullable|string',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function() use ($request) {
            $round = NursingRound::create([
                'admission_id' => $request->input('admission_id'),
                'staff_id' => auth()->id(),
                'scheduled_at' => now(),
                'completed_at' => now(),
                'task_type' => 'Full Institutional Assessment',
                'status' => 'completed',
                'notes' => $request->input('notes')
            ]);

            $news = \App\Services\NEWS2Service::calculate($request->all());

            VitalsRecord::create([
                'admission_id' => $request->input('admission_id'),
                'round_id' => $round->id,
                'temp' => $request->input('temp'),
                'pulse' => $request->input('pulse'),
                'bp_sys' => $request->input('bp_sys'),
                'bp_dia' => $request->input('bp_dia'),
                'spo2' => $request->input('spo2'),
                'respiratory_rate' => $request->input('respiratory_rate'),
                'news2_score' => $news['score'],
                'risk_level' => $news['risk_level'],
                'recorded_by' => auth()->id(),
                'recorded_at' => now()
            ]);

            Opeshis::logAction(
                'NURSING_ROUND_RECORD',
                'nursing_rounds',
                $round->id,
                "Recorded vitals and clinical notes for admission: {$request->input('admission_id')}"
            );
        });

        return redirect()->back()->with('success', 'Institutional nursing round recorded successfully.');
    }
}
