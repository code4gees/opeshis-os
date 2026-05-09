<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WarehouseStock;
use App\Models\StockRequisition;
use App\Models\WarehouseLedger;
use App\Models\Vendor;
use App\Models\User;
use App\Models\BloodBankInventory; // Using this as the standardized model
use App\Models\Inventory; // Pharmacy inventory
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class WarehouseController extends Controller
{
    /**
     * Institutional Warehouse & Logistics Command Hub
     */
    public function index(Request $request): View
    {
        $tab = $request->query('subtab', 'dashboard');
        $search = $request->query('search', '');
        $filterCat = $request->query('category', '');

        $data = [
            'tab' => $tab,
            'search' => $search,
            'filterCat' => $filterCat,
            'categories' => WarehouseStock::distinct()->orderBy('category')->pluck('category'),
        ];

        if ($tab === 'dashboard') {
            $data['bloodBank'] = BloodBankInventory::orderBy('blood_group')->get();
            $data['stats'] = [
                'total_items' => WarehouseStock::count(),
                'total_value' => WarehouseStock::sum(DB::raw('bulk_quantity * unit_cost')) ?: 0,
                'pending_reqs' => StockRequisition::where('status', 'pending')->count(),
                'expiring_soon' => WarehouseStock::where('expiry_date', '<=', now()->addDays(90))
                    ->where('expiry_date', '>=', now())
                    ->count(),
            ];
            $data['recent_activity'] = WarehouseLedger::with(['item', 'user'])
                ->orderBy('created_at', 'desc')
                ->limit(8)
                ->get();

        } elseif ($tab === 'stock' || $tab === 'dispatch') {
            $query = WarehouseStock::with('vendor');

            if ($search) { $query->where('item_name', 'ILIKE', "%$search%"); }
            if ($filterCat) { $query->where('category', $filterCat); }

            $data['stock'] = $query->orderBy('item_name', 'asc')->get();
            if ($tab === 'dispatch') {
                $data['staff'] = User::orderBy('name')->get();
            }

        } elseif ($tab === 'requisitions') {
            $data['requisitions'] = StockRequisition::with(['pharmacyItem', 'requester'])
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();
            $data['warehouseItems'] = WarehouseStock::where('bulk_quantity', '>', 0)
                ->orderBy('item_name')
                ->get();

        } elseif ($tab === 'vendors') {
            $data['vendors'] = Vendor::withCount('items')
                ->orderBy('name')
                ->get();
        }

        return view('warehouse', $data);
    }

    /**
     * Authorize Institutional Warehouse Action Protocol
     */
    public function action(
        Request $request, 
        \App\Actions\Ops\RegisterWarehouseStockAction $addStockAction,
        \App\Actions\Ops\DispatchWarehouseStockAction $dispatchAction,
        \App\Actions\Ops\RegisterVendorAction $registerVendorAction
    ): RedirectResponse
    {
        $actionType = $request->input('action');

        try {
            if ($actionType === 'add_stock') {
                $validated = $request->validate([
                    'item_name' => 'required|string',
                    'category' => 'required|string',
                    'bulk_quantity' => 'required|numeric',
                    'unit_cost' => 'required|numeric',
                    'vendor_id' => 'required|uuid|exists:vendors,id',
                    'batch_number' => 'nullable|string',
                    'min_quantity' => 'nullable|integer',
                    'expiry_date' => 'nullable|date',
                ]);

                $addStockAction->execute($validated);
                return redirect()->route('operations.supply.warehouse.index', ['subtab' => 'stock'])->with('success', 'Institutional item registered successfully.');

            } elseif ($actionType === 'deliver_req') {
                $reqId = $request->input('req_id');
                $whItemId = $request->input('warehouse_item_id');

                $dispatchAction->execute($reqId, $whItemId);
                return redirect()->route('operations.supply.warehouse.index', ['subtab' => 'requisitions'])->with('success', 'Institutional stock dispatched.');

            } elseif ($actionType === 'register_vendor') {
                $validated = $request->validate([
                    'name' => 'required|string',
                    'contact_person' => 'required|string',
                    'email' => 'required|email',
                ]);

                $registerVendorAction->execute($validated);
                return redirect()->route('operations.supply.warehouse.index', ['subtab' => 'vendors'])->with('success', 'Institutional vendor registered successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->route('operations.supply.warehouse.index', ['subtab' => $actionType === 'deliver_req' ? 'requisitions' : ($actionType === 'register_vendor' ? 'vendors' : 'stock')])->with('error', $e->getMessage());
        }

        return redirect()->route('operations.supply.warehouse.index');
    }
}
