<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\NicuFeeding;
use Illuminate\Support\Facades\Auth;

class LogNicuFeedingAction
{
    public function execute(array $data): NicuFeeding
    {
        return NicuFeeding::create(array_merge($data, [
            'recorded_by' => Auth::id(),
        ]));
    }
}
