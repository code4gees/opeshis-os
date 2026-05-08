<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\LabOrder;
use App\Models\RadiologyOrder;

class ResolveSignalAction
{
    /**
     * Authorize Institutional Signal Resolution Protocol
     */
    public function execute(string $type, string $id): void
    {
        if ($type === 'lab') {
            LabOrder::findOrFail($id)->update(['is_abnormal' => false]);
        } else {
            RadiologyOrder::findOrFail($id)->update(['is_abnormal' => false]);
        }
    }
}
