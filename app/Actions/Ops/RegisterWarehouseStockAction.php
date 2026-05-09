<?php

namespace App\Actions\Ops;

use App\Models\WarehouseStock;
use App\Models\WarehouseLedger;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterWarehouseStockAction
{
    /**
     * Authorize Institutional Warehouse Stock Registration
     */
    public function execute(array $data): WarehouseStock
    {
        return DB::transaction(function() use ($data) {
            $item = WarehouseStock::create([
                'item_name' => $data['item_name'],
                'category' => $data['category'],
                'bulk_quantity' => $data['bulk_quantity'],
                'unit_cost' => $data['unit_cost'],
                'vendor_id' => $data['vendor_id'],
                'batch_number' => $data['batch_number'] ?? null,
                'min_quantity' => $data['min_quantity'] ?? 10,
                'expiry_date' => $data['expiry_date'] ?? null,
                'modified_by' => Auth::id(),
            ]);

            WarehouseLedger::create([
                'warehouse_item_id' => $item->id,
                'movement_type' => 'IN',
                'quantity' => $data['bulk_quantity'],
                'previous_quantity' => 0,
                'new_quantity' => $data['bulk_quantity'],
                'notes' => 'Initial registration protocol established.',
                'recorded_by' => Auth::id(),
            ]);

            Opeshis::logAction('WAREHOUSE_STOCK_ADD', 'warehouse_stock', $item->id, "Protocol: Registered new stock item: {$item->item_name}.");

            return $item;
        });
    }
}
