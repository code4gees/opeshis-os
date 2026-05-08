<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChwHousehold;
use App\Models\ChwTask;
use App\Models\ChwScreening;
use App\Actions\Clinical\RegisterChwHouseholdAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CHWController extends Controller
{
    /**
     * Institutional Community Health Command Hub
     */
    public function index(): View
    {
        $households = ChwHousehold::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })->orderBy('created_at', 'desc')->get();
        $pendingTasksCount = ChwTask::where('status', 'pending')->count();
        
        $stats = [
            'households' => $households->count(),
            'tasks_pending' => $pendingTasksCount,
            'screenings_today' => ChwScreening::whereDate('created_at', today())->count(),
        ];

        return view('clinical.chw', compact('households', 'stats'));
    }

    /**
     * Authorize Institutional Household Census via Action
     */
    public function registerHousehold(Request $request, RegisterChwHouseholdAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'head_name' => 'required|string',
            'location' => 'required|string',
            'size' => 'required|integer',
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional household census record authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
