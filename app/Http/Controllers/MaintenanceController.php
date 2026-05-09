<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceRequest;
use App\Models\MaintenanceSchedule;
use App\Actions\Ops\CreateWorkOrderAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MaintenanceController extends Controller
{
    /**
     * Institutional Facilities & Maintenance Command Hub
     */
    public function index(): View
    {
        $workOrders = MaintenanceRequest::with('technician')
            ->orderBy('created_at', 'desc')
            ->get();

        $schedules = MaintenanceSchedule::orderBy('next_due', 'asc')->get();

        return view('ops.maintenance', compact('workOrders', 'schedules'));
    }

    /**
     * Authorize Institutional Maintenance Work Order via Action
     */
    public function createWorkOrder(Request $request, CreateWorkOrderAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'asset' => 'required|string',
            'priority' => 'required|in:urgent,routine,planned',
            'fault' => 'required|string',
            'assigned_to' => 'nullable|uuid|exists:users,id',
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional work order created and assigned.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Work Order Progression to In-Progress
     */
    public function startWorkOrder(Request $request, string $id): RedirectResponse
    {
        MaintenanceRequest::findOrFail($id)->update([
            'status' => 'in_progress',
            'started_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Institutional work order started.');
    }

    /**
     * Authorize Institutional Work Order Completion
     */
    public function completeWorkOrder(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate(['notes' => 'nullable|string']);

        MaintenanceRequest::findOrFail($id)->update([
            'status' => 'completed',
            'completion_notes' => $validated['notes'],
            'completed_at' => now(),
            'completed_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional work order completed.');
    }

    /**
     * Authorize Institutional Preventive Maintenance Schedule
     */
    public function createSchedule(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'asset' => 'required|string',
            'frequency' => 'required|in:daily,weekly,monthly,annual',
            'last_done' => 'nullable|date',
            'next_due' => 'required|date',
        ]);

        MaintenanceSchedules::create([
            'asset_description' => $validated['asset'],
            'frequency' => $validated['frequency'],
            'last_done' => $validated['last_done'],
            'next_due' => $validated['next_due'],
        ]);
        return redirect()->back()->with('success', 'Institutional maintenance schedule authorized.');
    }
}
