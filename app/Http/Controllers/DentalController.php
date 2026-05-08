<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DentalPatient;
use App\Models\DentalProcedure;
use App\Models\DentalToothChart;
use App\Models\DentalAppointment;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class DentalController extends Controller
{
    /**
     * Show Institutional Odontostomatology Command Hub
     */
    public function index(): View
    {
        $patients = DentalPatient::with(['patient'])
            ->orderBy('created_at', 'desc')
            ->get();

        $todaySchedule = DentalAppointment::with(['dentalPatient.patient'])
            ->whereDate('appointment_date', today())
            ->get();

        $procedures = \App\Models\DentalProcedureCatalog::orderBy('name')->get();

        return view('clinical.dental', compact('patients', 'todaySchedule', 'procedures'));
    }

    /**
     * Authorize Institutional Dental Registry Enrollment
     */
    public function registerPatient(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'complaint' => ['required', 'string'],
        ]);

        $dentalPatient = DentalPatient::create([
            'patient_id' => $validated['patient_id'],
            'chief_complaint' => $validated['complaint'],
            'registered_by' => auth()->id(),
        ]);

        Opeshis::logAction('DENTAL_REGISTER', 'dental_patients', $dentalPatient->id, 'Institutional Dental Enrollment authorized.');

        return redirect()->back()->with('success', 'Institutional dental registry enrollment authorized.');
    }

    /**
     * Commit Institutional Dental Procedure Intelligence
     */
    public function recordProcedure(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dental_patient_id' => ['required', 'uuid', 'exists:dental_patients,id'],
            'procedure_code' => ['required', 'string'],
            'tooth_number' => ['nullable', 'numeric'],
            'findings' => ['required', 'string'],
            'treatment' => ['required', 'string'],
            'cost' => ['nullable', 'numeric'],
        ]);

        $procedure = DentalProcedure::create([
            'dental_patient_id' => $validated['dental_patient_id'],
            'procedure_code' => $validated['procedure_code'],
            'tooth_number' => $validated['tooth_number'],
            'findings' => $validated['findings'],
            'treatment' => $validated['treatment'],
            'cost' => $validated['cost'],
            'recorded_by' => auth()->id(),
        ]);

        Opeshis::logAction('DENTAL_PROCEDURE', 'dental_procedures', $procedure->id, "Institutional Dental Treatment finalized: {$validated['treatment']}");

        return redirect()->back()->with('success', 'Institutional dental procedure intelligence committed.');
    }

    /**
     * Commit Institutional Tooth Chart Intelligence
     */
    public function updateToothChart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dental_patient_id' => ['required', 'uuid', 'exists:dental_patients,id'],
            'tooth_number' => ['required', 'numeric'],
            'status' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        DentalToothChart::updateOrCreate(
            ['dental_patient_id' => $validated['dental_patient_id'], 'tooth_number' => $validated['tooth_number']],
            ['status' => $validated['status'], 'notes' => $validated['notes']]
        );

        return redirect()->back()->with('success', 'Institutional tooth chart intelligence committed.');
    }

    /**
     * Authorize Institutional Dental Appointment Protocol
     */
    public function scheduleAppointment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dental_patient_id' => ['required', 'uuid', 'exists:dental_patients,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'reason' => ['required', 'string'],
        ]);

        DentalAppointment::create([
            'dental_patient_id' => $validated['dental_patient_id'],
            'appointment_date' => $validated['date'],
            'appointment_time' => $validated['time'],
            'reason' => $validated['reason'],
            'status' => 'scheduled',
        ]);

        return redirect()->back()->with('success', 'Institutional dental appointment protocol authorized.');
    }
}

