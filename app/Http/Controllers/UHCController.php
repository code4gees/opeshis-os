<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UhcIndicators;
use App\Models\UhcPeriods;
use App\Models\UhcResults;
use App\Models\MedicalRecord;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UHCController extends Controller
{
    /**
     * Show Institutional UHC Tracker Hub
     */
    public function index(): View
    {
        $indicators = UhcIndicators::all();
        $periods = UhcPeriods::orderBy('start_date', 'desc')->get();
        
        return view('admin.uhc_tracker', compact('indicators', 'periods'));
    }

    /**
     * Run Institutional UHC Calculation Engine
     */
    public function calculate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'period_id' => 'required|uuid|exists:uhc_periods,id',
        ]);
        
        $periodId = $validated['period_id'];
        $period = UhcPeriods::findOrFail($periodId);
        
        // Institutional Service Coverage Index calculation
        $coverage = MedicalRecord::whereBetween('created_at', [
                $period->start_date,
                $period->end_date
            ])->count();

        UhcResults::create([
            'period_id' => $periodId,
            'indicator_code' => 'SCI-001',
            'value' => $coverage,
            'calculated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Institutional UHC Index calculation complete.');
    }
}
