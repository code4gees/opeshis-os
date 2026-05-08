<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Opeshis;
use Illuminate\Support\Str;

use App\Models\Appointment;
use App\Models\PatientAppointmentRequest;
use App\Models\Department;
use App\Models\ActiveQueue;
use App\Models\Patient;
use App\Models\User;

class AppointmentController extends Controller
{
    /**
     * Show Institutional Appointment Hub
     */
    public function index(Request $request)
    {
        $date = $request->query('date', date('Y-m-d'));
        
        $departments = Department::orderBy('name')->get();
        
        $requests = PatientAppointmentRequest::with(['patient', 'department'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        $appointments = Appointment::with(['patient', 'doctor', 'department'])
            ->whereDate('appointment_date', $date)
            ->orderBy('appointment_time', 'asc')
            ->get();

        return view('appointments.index', compact('date', 'departments', 'requests', 'appointments'));
    }

    /**
     * Authorize Institutional Appointment Booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'doctor_id' => 'required|uuid|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        try {
            $year = date('Y');
            
            // Institutional Sequence Simulation (Ensuring unique numbering)
            $count = Appointment::whereYear('created_at', $year)->count() + 1;
            $sequence = str_pad((string)$count, 6, '0', STR_PAD_LEFT);
            $aptNumber = "APT-{$year}-{$sequence}";

            $appointment = Appointment::create([
                'appointment_number' => $aptNumber,
                'patient_id' => $request->input('patient_id'),
                'doctor_id' => $request->input('doctor_id'),
                'department_id' => $request->input('department_id'),
                'appointment_date' => $request->input('date'),
                'appointment_time' => $request->input('time'),
                'appointment_type' => $request->input('type', 'general_consult'),
                'status' => 'scheduled',
                'booked_by' => auth()->id(),
            ]);

            Opeshis::logAction('APPOINTMENT_BOOK', 'appointments', $appointment->id, "Appointment: {$aptNumber}");

            return redirect()->back()->with('success', "Institutional Appointment $aptNumber booked successfully.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Patient Check-in Protocol
     */
    public function checkIn($id)
    {
        try {
            DB::transaction(function() use ($id) {
                $apt = Appointment::findOrFail($id);

                $apt->update([
                    'status' => 'checked_in',
                ]);

                // Move to Institutional Active Queue
                ActiveQueue::create([
                    'patient_id' => $apt->patient_id,
                    'assigned_doctor_id' => $apt->doctor_id,
                    'intent' => 'Appointment: ' . $apt->appointment_number,
                    'status' => 'waiting',
                ]);

                Opeshis::logAction('APPOINTMENT_CHECKIN', 'appointments', $apt->id, "Patient checked in.");
            });

            return redirect()->back()->with('success', 'Patient checked in and moved to active clinical queue.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
