<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PftReversibility;
use Illuminate\Support\Facades\Auth;

class RecordPftReversibilityAction
{
    public function execute(array $data): PftReversibility
    {
        return PftReversibility::create([
            'session_id' => $data['session_id'],
            'post_bronchodilator_fev1' => $data['post_fev1'],
            'post_bronchodilator_fvc' => $data['post_fvc'],
            'reversibility_percent' => $data['reversibility'],
            'significant' => $data['significant'],
            'recorded_by' => Auth::id(),
        ]);
    }
}
