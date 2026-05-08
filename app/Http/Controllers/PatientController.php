<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Opeshis;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\LabOrder;
use App\Models\ActiveQueue;
use App\Http\Requests\StorePatientRequest;
use App\Actions\Clinical\RegisterPatientAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PatientController extends Controller
{
    /**
     * Institutional Patient Registry Pulse
     */
    public function index(Request $request): View
    {
        $search = $request->query('q', '');
        $query = Patient::query();

        if ($search) {
            $hash = Opeshis::generateSearchHash((string) $search);
            $query->where('medical_id', 'ILIKE', "%$search%")
                  ->orWhere('search_hash', $hash);
        }

        $patients = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('patients.index', compact('patients', 'search'));
    }

    /**
     * Show Comprehensive Patient Clinical Portfolio
     */
    public function show(string $id): View
    {
        $patient = Patient::where('id', $id)->orWhere('medical_id', $id)->firstOrFail();

        $visits = ActiveQueue::where('patient_id', $patient->id)->orderBy('created_at', 'desc')->get();
        $prescriptions = Prescription::where('patient_id', $patient->id)->orderBy('created_at', 'desc')->get();
        $labs = LabOrder::where('patient_id', $patient->id)->orderBy('created_at', 'desc')->get();

        Opeshis::logAction('PATIENT_VIEW', 'patients', $patient->id);

        return view('patients.show', compact('patient', 'visits', 'prescriptions', 'labs'));
    }

    /**
     * Authorize Rapid Patient Enrollment Protocol via Action
     */
    public function register(StorePatientRequest $request, RegisterPatientAction $action): RedirectResponse
    {
        try {
            $patient = $action->execute($request->validated());
            return redirect()->back()->with('success', "Institutional Patient {$patient->medical_id} registered successfully.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
