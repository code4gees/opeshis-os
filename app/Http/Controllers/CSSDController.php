<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CssdSterilizationLoads;
use App\Models\CssdSterilizers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CSSDController extends Controller
{
    /**
     * Institutional CSSD Dashboard
     */
    public function index(): View
    {
        $today = now()->toDateString();
        
        $loadStats = CssdSterilizationLoads::select(
                DB::raw('COUNT(*) as total'),
                DB::raw("SUM(CASE WHEN load_status = 'passed' THEN 1 ELSE 0 END) as passed"),
                DB::raw("SUM(CASE WHEN load_status = 'failed' OR load_status = 'quarantined' THEN 1 ELSE 0 END) as failed"),
                DB::raw("SUM(CASE WHEN load_status = 'in_progress' THEN 1 ELSE 0 END) as in_progress")
            )
            ->where('load_date', $today)
            ->first();

        $expiringCount = CssdSterilizationLoads::where('expiry_date', '<=', now()->addDays(14))
            ->where('load_status', 'passed')
            ->count();

        $sterilizers = CssdSterilizers::where('is_active', true)->get();

        $todayLoads = CssdSterilizationLoads::with('sterilizer')
            ->where('load_date', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cssd.index', compact('loadStats', 'expiringCount', 'sterilizers', 'todayLoads'));
    }

    /**
     * Start New Institutional Sterilization Load
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'sterilizer_id' => 'required|uuid|exists:cssd_sterilizers,id',
            'method' => 'required|string',
        ]);

        $loadNum = 'CSSD-' . now()->format('Ymd') . '-' . rand(100, 999);

        CssdSterilizationLoads::create([
            'load_number' => $loadNum,
            'sterilizer_id' => $validated['sterilizer_id'],
            'sterilization_method' => $validated['method'],
            'load_status' => 'in_progress',
            'load_date' => now()->toDateString(),
            'expiry_date' => now()->addMonths(6)->toDateString(),
        ]);

        return redirect()->back()->with('success', "Institutional Sterilization Load $loadNum initiated and authorized.");
    }
}
