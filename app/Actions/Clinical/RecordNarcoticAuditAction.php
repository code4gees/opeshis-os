<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\NarcoticStockCount;
use Illuminate\Support\Facades\Auth;

class RecordNarcoticAuditAction
{
    public function execute(array $data): NarcoticStockCount
    {
        return NarcoticStockCount::create([
            'stock_id' => $data['stock_id'],
            'physical_count' => $data['count'],
            'system_count' => $data['system_count'],
            'variance' => $data['count'] - $data['system_count'],
            'recorded_by' => Auth::id(),
        ]);
    }
}
