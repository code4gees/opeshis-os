<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\OncoCycle;
use Illuminate\Support\Facades\Auth;

class ClearOncoCycleAction
{
    public function execute(string $id): void
    {
        OncoCycle::findOrFail($id)->update([
            'status' => 'cleared',
            'cleared_by' => Auth::id(),
            'cleared_at' => now(),
        ]);
    }
}
