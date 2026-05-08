<?php

declare(strict_types=1);

namespace App\Actions\Diagnostics;

use App\Models\LabOrder;
use App\Helpers\Opeshis;

class VerifyLabResultAction
{
    /**
     * Authorize Institutional Diagnostic Verification Finalized
     */
    public function execute(string $orderId, string $results): void
    {
        $order = LabOrder::findOrFail($orderId);
        
        $order->update([
            'status' => 'completed',
            'results' => $results,
        ]);

        Opeshis::logAction(
            'LAB_RESULT_VERIFY',
            'lab_orders',
            $orderId,
            'Institutional Diagnostic Verification Finalized'
        );
    }
}
