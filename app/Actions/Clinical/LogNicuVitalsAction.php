<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\NicuVital;
use App\Models\Admission;
use App\Services\ClinicalRiskService;
use Illuminate\Support\Facades\Auth;

class LogNicuVitalsAction
{
    public function execute(array $data): array
    {
        $vital = NicuVital::create(array_merge($data, [
            'recorded_by' => Auth::id(),
        ]));

        $admission = Admission::findOrFail($data['admission_id']);
        $alerts = ClinicalRiskService::checkNICUAlerts($data, $admission->toArray());

        return ['vital' => $vital, 'alerts' => $alerts];
    }
}
