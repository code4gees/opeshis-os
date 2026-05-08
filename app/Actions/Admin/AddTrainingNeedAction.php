<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\TrainingNeeds;
use Illuminate\Support\Facades\Auth;

class AddTrainingNeedAction
{
    public function execute(array $data): TrainingNeeds
    {
        return TrainingNeeds::create([
            'user_id' => $data['user_id'],
            'need_description' => $data['description'],
            'identified_by' => Auth::id(),
        ]);
    }
}
