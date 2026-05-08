<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\NarcoticStockCount;
use Illuminate\Support\Facades\Auth;

class ResolveNarcoticDiscrepancyAction
{
    public function execute(string $id, array $data): NarcoticStockCount
    {
        $audit = NarcoticStockCount::findOrFail($id);
        
        $audit->update([
            'resolved' => true,
            'resolution_notes' => $data['notes'],
            'resolved_by' => Auth::id(),
            'resolved_at' => now(),
        ]);

        return $audit;
    }
}
