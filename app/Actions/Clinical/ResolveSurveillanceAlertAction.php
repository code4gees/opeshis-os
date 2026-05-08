<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\SurveillanceAlert;

class ResolveSurveillanceAlertAction
{
    public function execute(string $id): void
    {
        SurveillanceAlert::findOrFail($id)->update([
            'resolved' => true,
            'resolved_at' => now(),
        ]);
    }
}
