<?php

namespace App\Actions\Ops;

use App\Models\WarehouseStock;
use App\Models\WarehouseLedger;
use App\Models\StockRequisition;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DispatchWarehouseStockAction
{
    /**
     * Authorize Institutional Warehouse Stock Dispatch
     */
    public function execute(string $reqId, string $whItemId): void
    {
        DB::transaction(function() use ($reqId, $whItemId) {
            $req = StockRequisition::where('id', $reqId)
                ->where('status', 'approved')
                ->lockForUpdate()
                ->firstOrFail();

            $wh = WarehouseStock::where('id', $whItemId)
                ->lockForUpdate()
                ->firstOrFail();

            if ($wh->bulk_quantity < $req->requested_qty) {
                throw new \Exception("Insufficient institutional stock in warehouse.");
            }

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
                'recorded_by' => Auth::id(),
            ]);

            Opeshis::logAction('WAREHOUSE_STOCK_DISPATCH', 'stock_requisitions', $reqId, "Protocol: Dispatched {$req->requested_qty} units for requisition.");
        });
    }
}
