<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PsychMSE;
use Illuminate\Support\Facades\Auth;

class RecordPsychMSEAction
{
    public function execute(array $data): PsychMSE
    {
        return PsychMSE::create(array_merge($data, ['recorded_by' => Auth::id()]));
    }
}
