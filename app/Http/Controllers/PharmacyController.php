<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Inventory;
use App\Models\StockRequisition;
use App\Actions\Pharmacy\AcknowledgeStockReceiptAction;
use App\Actions\DispenseMedicationAction;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PharmacyController extends Controller
{
    /**
     * Show the Institutional Pharmaceutical Command Hub
     */
    public function index(Request $request): View
    {
        $tab = $request->query('subtab', 'dispensing');

        $pending = Prescription::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with('patient')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        $inventory = Inventory::with('formulary')
            ->whereIn('category', ['Medication', 'Consumables'])
            ->orderBy('item_name', 'asc')
            ->get();

        $totalValuation = $inventory->reduce(fn($carry, $item) => $carry + (($item->stock_level ?? 0) * ($item->formulary->base_price ?? 0)), 0);
        $lowStockCount = $inventory->filter(fn($i) => ($i->stock_level ?? 0) <= ($i->reorder_level ?? 0))->count();

        $orders = StockRequisition::with('item')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        $history = Prescription::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('patient', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with('patient')
            ->where('status', 'dispensed')
            ->orderBy('dispensed_at', 'desc')
            ->limit(100)
            ->get();

        return view('pharmacy', [
            'tab' => $tab,
            'pending' => $pending,
            'inventory' => $inventory,
            'totalValuation' => $totalValuation,
            'lowStockCount' => $lowStockCount,
            'orders' => $orders,
            'history' => $history
        ]);
    }

    /**
     * Handle Institutional Pharmaceutical Actions Protocol via Actions
     */
    public function action(
        Request $request, 
        DispenseMedicationAction $dispenseAction,
        AcknowledgeStockReceiptAction $receiptAction,
        \App\Actions\Pharmacy\RequestPharmacyStockAction $requestStockAction
    ): RedirectResponse {
        $action = $request->input('action');

        try {
            if ($action === 'dispense') {
                $request->validate(['prescription_id' => 'required|uuid']);
                $dispenseAction->execute($request->input('prescription_id'));
                return redirect()->route('operations.diagnostics.pharmacy.index', ['subtab' => 'dispensing'])->with('success', 'Institutional medication dispensing protocol finalized.');

            } elseif ($action === 'request_stock') {
                $validated = $request->validate([
                    'inventory_id' => 'required|uuid',
                    'qty' => 'required|numeric|min:1'
                ]);
                $requestStockAction->execute($validated);
                return redirect()->route('operations.diagnostics.pharmacy.index', ['subtab' => 'orders'])->with('success', 'Institutional stock requisition sent to warehouse.');

            } elseif ($action === 'acknowledge_receipt') {
                $request->validate(['req_id' => 'required|uuid']);
                $receiptAction->execute($request->input('req_id'));
                return redirect()->route('operations.diagnostics.pharmacy.index', ['subtab' => 'orders'])->with('success', 'Institutional stock receipt acknowledged and updated.');
            }
        } catch (\Exception $e) {
            return redirect()->route('operations.diagnostics.pharmacy.index', ['subtab' => $request->input('action') === 'dispense' ? 'dispensing' : 'orders'])->with('error', $e->getMessage());
        }

        return redirect()->route('operations.diagnostics.pharmacy.index');
    }
}
