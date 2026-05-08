<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FpClient;
use App\Models\FpMethod;
use App\Models\FpVisit;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FamilyPlanningController extends Controller
{
    /**
     * Institutional Reproductive Health Command Hub
     */
    public function index(): View
    {
        $clients = FpClient::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with(['patient', 'currentMethod'])
            ->orderBy('created_at', 'desc')
            ->get();

        $methods = [
            'Combined OCP', 
            'Progesterone-only Pill', 
            'DMPA Injection', 
            'Implant', 
            'IUD/IUS', 
            'Condom', 
            'Sterilization', 
            'LAM'
        ];

        return view('clinical.fp', compact('clients', 'methods'));
    }

    /**
     * Authorize Institutional Programme Enrollment
     */
    public function enroll(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid'],
        ]);

        $client = FpClient::create([
            'patient_id' => $validated['patient_id'],
            'enrolled_by' => auth()->id(),
        ]);

        Opeshis::logAction('FP_ENROLL', 'fp_clients', $client->id, "Protocol: Reproductive Health Enrollment authorized.");

        return redirect()->back()->with('success', 'Institutional programme enrollment authorized.');
    }

    /**
     * Authorize Institutional Method Calibration Protocol
     */
    public function recordMethod(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_id' => ['required', 'uuid'],
            'method' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'next_visit' => ['required', 'date'],
        ]);

        FpMethod::where('client_id', $validated['client_id'])->update(['active' => false]);

        FpMethod::create([
            'client_id' => $validated['client_id'],
            'method_name' => $validated['method'],
            'start_date' => $validated['start_date'],
            'next_visit' => $validated['next_visit'],
            'active' => true,
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional method calibration protocol authorized.');
    }

    /**
     * Commit Institutional Counseling Session Intelligence
     */
    public function recordVisit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_id' => ['required', 'uuid'],
            'notes' => ['required', 'string'],
            'side_effects' => ['nullable', 'string'],
        ]);

        FpVisit::create([
            'client_id' => $validated['client_id'],
            'visit_notes' => $validated['notes'],
            'side_effects' => $validated['side_effects'],
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional counseling session intelligence committed.');
    }
}
