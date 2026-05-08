<?php

declare(strict_types=1);

namespace App\Actions\Diagnostics;

use App\Models\LabOrder;
use App\Helpers\Opeshis;

class CollectLabSampleAction
{
    public function execute(string $orderId): void
    {
        LabOrder::findOrFail($orderId)->update(['status' => 'In Analysis']);
        Opeshis::logAction('LAB_SAMPLE_COLLECT', 'lab_orders', $orderId, 'Institutional Specimen Collection Authorized');
    }
}
