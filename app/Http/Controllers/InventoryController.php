<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display the Central Inventory Module
     */
    public function index()
    {
        $items = Inventory::orderBy('item_name', 'asc')->paginate(50);
        
        return view('operations.inventory', compact('items'));
    }

    /**
     * Handle inventory actions (restock, dispatch)
     */
    public function action(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:sys_inventory,id',
            'action_type' => 'required|in:restock,dispatch',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $item = Inventory::findOrFail($request->item_id);
            
            if ($request->action_type === 'dispatch') {
                if ($item->stock_level < $request->quantity) {
                    throw new \Exception("Insufficient stock for {$item->item_name}. Available: {$item->stock_level}");
                }
                $item->stock_level -= $request->quantity;
            } else {
                $item->stock_level += $request->quantity;
            }

            $item->save();

            AuditLog::log(
                auth()->id(),
                'inventory_update',
                "{$request->action_type}ed {$request->quantity} units of {$item->item_name}. Reason: {$request->reason}",
                $request->ip()
            );

            DB::commit();

            return back()->with('success', "Inventory updated successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', "Failed to update inventory: " . $e->getMessage());
        }
    }
}
