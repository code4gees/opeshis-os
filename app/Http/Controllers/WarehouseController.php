<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WarehouseStock;
use App\Models\StockRequisitions;
use App\Models\WarehouseLedger;
use App\Models\Vendors;
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
                'pending_reqs' => StockRequisitions::where('status', 'pending')->count(),
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
            $data['requisitions'] = StockRequisitions::with(['pharmacyItem', 'requester'])
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();
            $data['warehouseItems'] = WarehouseStock::where('bulk_quantity', '>', 0)
                ->orderBy('item_name')
                ->get();

        } elseif ($tab === 'vendors') {
            $data['vendors'] = Vendors::withCount('items')
                ->orderBy('name')
                ->get();
        }

        return view('warehouse', $data);
    }

    /**
     * Authorize Institutional Warehouse Action Protocol
     */
    public function action(Request $request): RedirectResponse
    {
        $action = $request->input('action');
        $user_id = auth()->id();

        try {
            if ($action === 'add_stock') {
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

                DB::transaction(function() use ($validated, $user_id) {
                    $item = WarehouseStock::create([
                        'item_name' => $validated['item_name'],
                        'category' => $validated['category'],
                        'bulk_quantity' => $validated['bulk_quantity'],
                        'unit_cost' => $validated['unit_cost'],
                        'vendor_id' => $validated['vendor_id'],
                        'batch_number' => $validated['batch_number'],
                        'min_quantity' => $validated['min_quantity'] ?? 10,
                        'expiry_date' => $validated['expiry_date'],
                        'modified_by' => $user_id,
                    ]);

                    WarehouseLedger::create([
                        'warehouse_item_id' => $item->id,
                        'movement_type' => 'IN',
                        'quantity' => $validated['bulk_quantity'],
                        'previous_quantity' => 0,
                        'new_quantity' => $validated['bulk_quantity'],
                        'notes' => 'Initial registration protocol established.',
                        'recorded_by' => $user_id,
                    ]);

                    Opeshis::logAction('WAREHOUSE_STOCK_ADD', 'warehouse_stock', $item->id, "Protocol: Registered new stock item: {$item->item_name}.");
                });
                return redirect()->route('warehouse', ['subtab' => 'stock'])->with('success', 'Institutional item registered successfully.');

            } elseif ($action === 'deliver_req') {
                $reqId = $request->input('req_id');
                $whItemId = $request->input('warehouse_item_id');

                DB::transaction(function() use ($reqId, $whItemId, $user_id) {
                    $req = StockRequisitions::where('id', $reqId)->where('status', 'approved')->lockForUpdate()->first();
                    if ($req && $whItemId) {
                        $wh = WarehouseStock::where('id', $whItemId)->lockForUpdate()->first();
                        if ($wh && $wh->bulk_quantity >= $req->requested_qty) {
                            $wh->decrement('bulk_quantity', $req->requested_qty);
                            $req->update([
                                'status' => 'dispatched',
                                'warehouse_item_id' => $whItemId
                            ]);
                            
                            WarehouseLedger::create([
                                'warehouse_item_id' => $whItemId,
                                'movement_type' => 'OUT',
                                'quantity' => $req->requested_qty,
                                'previous_quantity' => $wh->bulk_quantity + $req->requested_qty,
                                'new_quantity' => $wh->bulk_quantity,
                                'reference_id' => $reqId,
                                'reference_type' => 'requisition',
                                'notes' => 'Pharmacy Order Fulfillment Protocol.',
                                'recorded_by' => $user_id,
                            ]);

                            Opeshis::logAction('WAREHOUSE_STOCK_DISPATCH', 'stock_requisitions', $reqId, "Protocol: Dispatched {$req->requested_qty} units for requisition.");
                        } else {
                            throw new \Exception("Insufficient institutional stock in warehouse.");
                        }
                    }
                });
                return redirect()->route('warehouse', ['subtab' => 'requisitions'])->with('success', 'Institutional stock dispatched.');

            } elseif ($action === 'register_vendor') {
                $validated = $request->validate([
                    'name' => 'required|string',
                    'contact_person' => 'required|string',
                    'email' => 'required|email',
                ]);

                $vendor = Vendors::create([
                    'name' => $validated['name'],
                    'contact_person' => $validated['contact_person'],
                    'email' => $validated['email'],
                    'status' => 'active',
                ]);
                
                Opeshis::logAction('VENDOR_REGISTER', 'vendors', $vendor->id, "Protocol: Registered new vendor: {$vendor->name}.");
                
                return redirect()->route('warehouse', ['subtab' => 'vendors'])->with('success', 'Institutional vendor registered successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
