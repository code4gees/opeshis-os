<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Opeshis;
use Illuminate\Support\Str;
use App\Models\Admission;
use App\Models\Ward;
use App\Models\WardBed;
use App\Models\Patient;

class AdmissionController extends Controller
{
    /**
     * Show Institutional Admission Census & Ward Management Hub
     */
    public function index()
    {
        $wards = Ward::with(['beds.patient'])->get();

        foreach ($wards as $ward) {
            $ward->occupied_count = $ward->beds->where('status', 'Occupied')->count();
            $ward->available_count = $ward->beds->where('status', 'available')->count();
        }

        $activeAdmissions = Admission::with(['patient', 'bed.ward'])
            ->where('status', 'admitted')
            ->orderBy('admitted_at', 'desc')
            ->get();

        $totalBeds = WardBed::count();
        $occupancyRate = $totalBeds > 0 
            ? round((WardBed::where('status', 'Occupied')->count() / $totalBeds) * 100) 
            : 0;

        return view('admissions.index', compact('wards', 'activeAdmissions', 'occupancyRate'));
    }

    /**
     * Authorize Patient Admission Protocol
     */
    public function admit(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'ward_id' => 'required|uuid|exists:wards,id',
            'bed_id' => 'required|uuid|exists:ward_beds,id',
            'diagnosis' => 'required|string',
        ]);

        DB::transaction(function() use ($request) {
            $admission = Admission::create([
                'patient_id' => $request->input('patient_id'),
                'ward_id' => $request->input('ward_id'),
                'bed_id' => $request->input('bed_id'),
                'admitting_doctor_id' => auth()->id(),
                'admitting_diagnosis' => $request->input('diagnosis'),
                'consultant' => $request->input('consultant'),
                'status' => 'admitted',
                'admitted_at' => now(),
            ]);

            WardBed::where('id', $request->input('bed_id'))->update([
                'status' => 'Occupied',
                'patient_id' => $request->input('patient_id'),
            ]);

            Opeshis::logAction('ADMISSION_REGISTER', 'ward_admissions', $admission->id, "Diagnosis: {$request->input('diagnosis')}");
        });

        return redirect()->back()->with('success', 'Patient successfully admitted to institutional ward protocol.');
    }

    /**
     * Authorize Patient Discharge Protocol
     */
    public function discharge(Request $request, $id)
    {
        $admission = Admission::findOrFail($id);

        DB::transaction(function() use ($admission, $request) {
            $admission->update([
                'status' => 'discharged',
                'discharge_diagnosis' => $request->input('discharge_diagnosis'),
                'discharge_summary' => $request->input('summary'),
                'discharged_at' => now(),
                'discharged_by' => auth()->id()
            ]);

            WardBed::where('id', $admission->bed_id)->update([
                'status' => 'available',
                'patient_id' => null,
            ]);

            Opeshis::logAction('ADMISSION_DISCHARGE', 'ward_admissions', $admission->id, "Patient discharged.");
        });

        return redirect()->back()->with('success', 'Patient institutional discharge finalized.');
    }

    /**
     * Retrieve Available Beds for Ward Signal
     */
    public function getAvailableBeds(Request $request)
    {
        $beds = WardBed::where('status', 'available')
            ->where('ward_id', $request->ward_id)
            ->get();
            
        return response()->json($beds);
    }
}
