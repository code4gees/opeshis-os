<?php

declare(strict_types=1);

namespace App\Actions\Pharmacy;

use App\Models\StockRequisition;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\Auth;

class RequestPharmacyStockAction
{
    public function execute(array $data): StockRequisition
    {
        $requisition = StockRequisition::create([
            'pharmacy_item_id' => $data['inventory_id'],
            'requested_qty' => $data['qty'],
            'status' => 'pending',
            'requested_by' => Auth::id(),
        ]);

        Opeshis::logAction('PHARMACY_STOCK_REQUEST', 'stock_requisitions', $requisition->id, "Institutional Stock Requisition: {$data['qty']} Units Authorized");

        return $requisition;
    }
}
