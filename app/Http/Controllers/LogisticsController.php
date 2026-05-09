<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogisticsLog;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LogisticsController extends Controller
{
    /**
     * Show Institutional Logistics Hub (Laundry, Fleet, Housekeeping)
     */
    public function index(string $module): View
    {
        $allowed = ['laundry', 'fleet', 'housekeeping'];
        if (!in_array($module, $allowed)) abort(404);

        $logs = LogisticsLog::where('module_type', $module)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ops.logistics', compact('logs', 'module'));
    }

    /**
     * Commit Institutional Logistics Event Record
     */
    public function record(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'module_type' => 'required|in:laundry,fleet,housekeeping',
            'description' => 'required|string',
            'status' => 'nullable|string',
        ]);

        LogisticsLog::create([
            'module_type' => $validated['module_type'],
            'event_description' => $validated['description'],
            'status' => $validated['status'] ?? 'completed',
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional logistics record established.');
    }
}
