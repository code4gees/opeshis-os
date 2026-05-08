<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PaedsGrowth;
use Illuminate\Support\Facades\Auth;

class LogPaedsGrowthAction
{
    public function execute(array $data): PaedsGrowth
    {
        return PaedsGrowth::create([
            'admission_id' => $data['admission_id'],
            'weight_kg' => $data['weight'],
            'height_cm' => $data['height'],
            'head_circumference_cm' => $data['hc'],
            'muac_cm' => $data['muac'],
            'recorded_by' => Auth::id(),
        ]);
    }
}
