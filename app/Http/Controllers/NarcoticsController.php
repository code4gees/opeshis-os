<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NarcoticStock;
use App\Models\NarcoticMovement;
use App\Models\NarcoticStockCount;
use App\Actions\Clinical\LogNarcoticMovementAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class NarcoticsController extends Controller
{
    /**
     * Institutional Narcotics Command Hub
     */
    public function index(): View
    {
        $register = NarcoticStock::all();
        $movements = NarcoticMovement::with(['stock', 'patient'])
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return view('clinical.narcotics', compact('register', 'movements'));
    }

    /**
     * Authorize Institutional Controlled Substance Movement via Action
     */
    public function logMovement(Request $request, LogNarcoticMovementAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'stock_id' => ['required', 'uuid', 'exists:narcotics_register,id'],
            'type' => ['required', 'string'],
            'quantity' => ['required', 'numeric'],
            'balance_after' => ['required', 'numeric'],
            'patient_id' => ['nullable', 'uuid'],
            'witness' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional narcotics movement recorded and authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Fetch Institutional Narcotics Inventory Intelligence
     */
    public function getInventory(): JsonResponse
    {
        return response()->json(NarcoticStock::all());
    }

    /**
     * Commit Institutional Narcotic Stock Audit via Action
     */
    public function recordCount(Request $request, \App\Actions\Clinical\RecordNarcoticAuditAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'stock_id' => ['required', 'uuid', 'exists:narcotics_register,id'],
            'count' => ['required', 'numeric'],
            'system_count' => ['required', 'numeric'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional narcotic stock audit committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Discrepancy Resolution Protocol via Action
     */
    public function resolveDiscrepancy(Request $request, string $id, \App\Actions\Clinical\ResolveNarcoticDiscrepancyAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'notes' => ['required', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional discrepancy resolution protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Generate Institutional Monthly Narcotics Security Report
     */
    public function generateReport(): View
    {
        $movements = NarcoticMovement::with(['stock', 'patient'])
            ->whereDate('created_at', '>=', now()->startOfMonth())
            ->get();

        return view('clinical.narcotics_report', compact('movements'));
    }
}
