<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PsychMedication;
use Illuminate\Support\Facades\Auth;

class UpdatePsychMedAction
{
    public function execute(string $id, array $data): PsychMedication
    {
        $med = PsychMedication::findOrFail($id);
        $med->update(array_merge($data, ['updated_by' => Auth::id()]));
        return $med;
    }
}
