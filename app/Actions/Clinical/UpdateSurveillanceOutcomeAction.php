<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\SurveillanceCase;
use Illuminate\Support\Facades\Auth;

class UpdateSurveillanceOutcomeAction
{
    public function execute(string $id, array $data): void
    {
        SurveillanceCase::findOrFail($id)->update([
            'outcome' => $data['outcome'],
            'updated_by' => Auth::id(),
        ]);
    }
}
