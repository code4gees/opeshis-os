<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryCycle;
use App\Models\LaundryInventory;
use App\Models\LaundryIssue;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LaundryController extends Controller
{
    /**
     * Institutional Laundry & Linen Services Hub
     */
    public function index(): View
    {
        $cycles = LaundryCycle::orderBy('created_at', 'desc')->take(50)->get();
        $inventory = LaundryInventory::orderBy('item_name')->get();
        $stats = [
            'cycles_today' => LaundryCycle::whereDate('created_at', today())->count(),
            'low_stock' => LaundryInventory::where('quantity', '<', 10)->count(),
        ];
        return view('ops.laundry', compact('cycles', 'inventory', 'stats'));
    }

    /**
     * Authorize Institutional Laundry Cycle Protocol
     */
    public function startCycle(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'machine_id' => 'required|string',
            'load_type' => 'required|string',
            'items' => 'required|integer',
            'temperature' => 'required|numeric',
        ]);

        LaundryCycle::create([
            'machine_id' => $validated['machine_id'],
            'load_type' => $validated['load_type'],
            'items_count' => $validated['items'],
            'temperature' => $validated['temperature'],
            'status' => 'running',
            'started_by' => auth()->id(),
            'started_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Institutional laundry cycle started.');
    }

    /**
     * Update Institutional Laundry Cycle Status
     */
    public function updateCycle(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        LaundryCycle::findOrFail($id)->update([
            'status' => $validated['status'],
            'completed_at' => $validated['status'] === 'completed' ? now() : null,
            'notes' => $validated['notes'],
        ]);
        return redirect()->back()->with('success', 'Institutional cycle status updated.');
    }

    /**
     * Authorize Institutional Linen Issue Protocol
     */
    public function issueLinen(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'item_id' => 'required|uuid|exists:laundry_inventory,id',
            'quantity' => 'required|integer|min:1',
            'ward' => 'required|string',
        ]);

        $item = LaundryInventory::findOrFail($validated['item_id']);
        
        $issue = LaundryIssue::create([
            'item_id' => $validated['item_id'],
            'quantity' => $validated['quantity'],
            'issued_to' => $validated['ward'],
            'issued_by' => auth()->id(),
        ]);

        $item->decrement('quantity', $validated['quantity']);

        Opeshis::logAction('LINEN_ISSUE', 'laundry_issues', $issue->id, "{$validated['quantity']} items → {$validated['ward']}");
        return redirect()->back()->with('success', 'Institutional linen issued.');
    }
}
