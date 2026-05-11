<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Opeshis;
use Illuminate\Support\Str;

class EmergencyController extends Controller
{
    /**
     * Show Institutional Emergency Command Center
     */
    public function index()
    {
        $activeEmergencies = \App\Models\ActiveQueue::with('patient')
            ->where('intent', 'emergency')
            ->where('status', '!=', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();

        $resuscitationCases = \App\Models\Admission::with(['patient', 'bed.ward'])
            ->whereHas('bed.ward', function($query) {
                $query->where('category', 'ICU');
            })
            ->whereNull('discharged_at')
            ->get();

        return view('emergency.index', compact('activeEmergencies', 'resuscitationCases'));
    }

    /**
     * Authorize Institutional Emergency Intake Protocol
     */
    public function intake(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'gender' => 'required|string',
        ]);

        try {
            $medicalIdPool = \App\Models\MedicalIdPool::where('status', 'unassigned')->first();
            if (!$medicalIdPool) throw new \Exception("Institutional ID pool exhausted.");
            
            $medicalId = $medicalIdPool->medical_id;

            $patient = DB::transaction(function() use ($request, $medicalId, $medicalIdPool) {
                $patient = \App\Models\Patient::create([
                    'medical_id' => $medicalId,
                    'full_name' => $request->input('full_name'),
                    'gender' => $request->input('gender'),
                    'dob' => now()->subYears(20)->toDateString(), // Mock DOB for emergency
                    'branch_id' => auth()->user()->branch_id ?? null,
                ]);

                $medicalIdPool->update([
                    'status' => 'assigned',
                    'patient_id' => $patient->id,
                    'assigned_at' => now()
                ]);

                $queue = \App\Models\ActiveQueue::create([
                    'patient_id' => $patient->id,
                    'intent' => 'emergency',
                    'status' => 'waiting',
                ]);

                Opeshis::logAction('EMERGENCY_INTAKE', 'active_queue', $queue->id, "Institutional Emergency Intake: {$patient->medical_id}");

                return $patient;
            });

            return redirect()->route('clinical.emergency.index')->with('success', "Institutional Emergency Case {$patient->medical_id} established.");

        } catch (\Exception $e) {
            return redirect()->route('clinical.emergency.index')->with('error', $e->getMessage());
        }
    }
}
