<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbCase;
use App\Models\TbDotsLog;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TbController extends Controller
{
    /**
     * Institutional TB Surveillance Command
     */
    public function index(): View
    {
        $cases = TbCase::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with('patient')->orderBy('created_at', 'desc')->get();
        
        foreach ($cases as $c) {
            $c->dots_count = TbDotsLog::where('case_id', $c->id)->count();
        }

        return view('clinical.tb', compact('cases'));
    }

    /**
     * Register Institutional TB Case Protocol
     */
    public function registerCase(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'tb_type' => 'required|string',
            'regimen' => 'required|string',
            'sputum' => 'nullable|string',
        ]);

        $case = TbCase::create([
            'patient_id' => $validated['patient_id'],
            'tb_type' => $validated['tb_type'],
            'regimen' => $validated['regimen'],
            'sputum_result' => $validated['sputum'] ?? 'Not Tested',
            'registered_by' => auth()->id(),
        ]);

        Opeshis::logAction('TB_REGISTER', 'tb_cases', $case->id, "TB case registered: {$validated['tb_type']}.");
        
        return redirect()->back()->with('success', 'Institutional TB case registered and authorized.');
    }

    /**
     * Log Institutional DOTS Observation Protocol
     */
    public function logDOTS(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => 'required|uuid|exists:tb_cases,id',
            'observed' => 'required|string',
            'date' => 'nullable|date',
        ]);

        TbDotsLog::create([
            'case_id' => $validated['case_id'],
            'observed' => $validated['observed'] === 'yes',
            'treatment_date' => $validated['date'] ?? now()->toDateString(),
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional DOTS observation recorded.');
    }
}
