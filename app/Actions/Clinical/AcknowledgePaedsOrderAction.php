<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PaedsOrder;
use Illuminate\Support\Facades\Auth;

class AcknowledgePaedsOrderAction
{
    public function execute(string $id): void
    {
        PaedsOrder::where('id', $id)->update([
            'status' => 'acknowledged',
            'acknowledged_by' => Auth::id(),
            'acknowledged_at' => now()
        ]);
    }
}
