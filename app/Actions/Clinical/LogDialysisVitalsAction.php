<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\DialysisVital;
use Illuminate\Support\Facades\Auth;

class LogDialysisVitalsAction
{
    public function execute(array $data): DialysisVital
    {
        return DialysisVital::create(array_merge($data, [
            'recorded_by' => Auth::id(),
        ]));
    }
}
