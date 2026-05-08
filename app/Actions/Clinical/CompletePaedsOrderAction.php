<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PaedsOrder;
use Illuminate\Support\Facades\Auth;

class CompletePaedsOrderAction
{
    public function execute(string $id, array $data): void
    {
        PaedsOrder::where('id', $id)->update([
            'status' => 'completed',
            'completed_by' => Auth::id(),
            'completed_at' => now(),
            'completion_notes' => $data['notes'] ?? null
        ]);
    }
}
