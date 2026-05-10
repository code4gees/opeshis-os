<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\LabOrder;
use App\Models\Admission;
use App\Models\VitalsRecord;
use Illuminate\Support\Str;

class PatientApiController extends Controller
{
    /**
     * Patient Mobile App Login (Institutional Forensic Gateway)
     */
    public function login(Request $request)
    {
        $request->validate([
            'medical_id' => 'required',
            'phone_number' => 'required'
        ]);

        // Forensic Query via Eloquent
        $patient = Patient::where('medical_id', $request->medical_id)
            ->where('phone', $request->phone_number)
            ->first();

        if (!$patient) {
            return response()->json(['success' => false, 'message' => 'Institutional Access Denied: Invalid Credentials'], 401);
        }

        return response()->json([
            'success' => true,
            'token' => 'SIMULATED_TOKEN_' . Str::random(32),
            'patient' => [
                'id' => $patient->id,
                'name' => $patient->full_name, // Eloquent handles decryption
                'medical_id' => $patient->medical_id
            ]
        ]);
    }

    /**
     * Get Dashboard Telemetry
     */
    public function dashboard(Request $request)
    {
        $patientId = $request->query('patient_id');
        
        $patient = Patient::find($patientId);
        if (!$patient) return response()->json(['error' => 'Patient Signal Lost'], 404);

        $nextAppt = Appointment::with('doctor')
            ->where('patient_id', $patientId)
            ->where('appointment_date', '>=', now()->toDateString())
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->orderBy('appointment_date')
            ->first();

        // Retrieve latest vitals from most recent admission
        $latestAdmission = Admission::where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->first();

        $vitals = $latestAdmission 
            ? VitalsRecord::where('admission_id', $latestAdmission->id)->orderBy('recorded_at', 'desc')->first()
            : null;

        return response()->json([
            'patient' => [
                'name' => $patient->full_name,
                'blood_group' => $patient->blood_group,
                'genotype' => $patient->genotype
            ],
            'next_appointment' => $nextAppt ? [
                'date' => $nextAppt->appointment_date,
                'time' => $nextAppt->appointment_time,
                'doctor' => $nextAppt->doctor->name ?? 'Specialist'
            ] : null,
            'vitals' => $vitals
        ]);
    }

    /**
     * Get Longitudinal Appointment Archive
     */
    public function appointments(Request $request)
    {
        $patientId = $request->query('patient_id');
        $history = Appointment::with('doctor')
            ->where('patient_id', $patientId)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return response()->json($history);
    }

    /**
     * Get Clinical Diagnostic Results
     */
    public function labResults(Request $request)
    {
        $patientId = $request->query('patient_id');
        $results = LabOrder::where('patient_id', $patientId)
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($results);
    }
}
