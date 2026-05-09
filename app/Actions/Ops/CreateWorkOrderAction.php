<?php

declare(strict_types=1);

namespace App\Actions\Ops;

use App\Models\MaintenanceRequest;
use App\Helpers\Opeshis;

class CreateWorkOrderAction
{
    /**
     * Authorize Institutional Maintenance Work Order
     */
    public function execute(array $data): MaintenanceRequest
    {
        $wo = MaintenanceRequest::create([
            'asset_description' => $data['asset'],
            'priority' => $data['priority'],
            'fault_description' => $data['fault'],
            'assigned_to' => $data['assigned_to'] ?? null,
            'status' => 'open',
            'raised_by' => auth()->id(),
        ]);

        Opeshis::logAction('MAINT_WO_CREATE', 'maintenance_work_orders', $wo->id, "Protocol: Work order raised for {$data['asset']}.");

        return $wo;
    }
}
