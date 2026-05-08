<?php

declare(strict_types=1);

namespace App\Actions\Pharmacy;

use App\Models\StockRequisition;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;

class AcknowledgeStockReceiptAction
{
    /**
     * Authorize Institutional Stock Receipt Acknowledgment
     */
    public function execute(string $requisitionId): void
    {
        DB::transaction(function () use ($requisitionId) {
            $req = StockRequisition::where('id', $requisitionId)
                ->where('status', 'dispatched')
                ->lockForUpdate()
                ->firstOrFail();

            $req->update([
                'status' => 'completed',
                'received_at' => now()
            ]);

            $req->item->increment('stock_level', $req->requested_qty);

            Opeshis::logAction(
                'PHARMACY_STOCK_RECEIVE',
                'stock_requisitions',
                $requisitionId,
                "Institutional Stock Receipt Acknowledged: {$req->requested_qty} Units"
            );
        });
    }
}
