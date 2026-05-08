<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\DialysisLab;
use Illuminate\Support\Facades\Auth;

class RecordRenalLabsAction
{
    public function execute(array $data): DialysisLab
    {
        return DialysisLab::create(array_merge($data, [
            'recorded_by' => Auth::id(),
        ]));
    }
}
