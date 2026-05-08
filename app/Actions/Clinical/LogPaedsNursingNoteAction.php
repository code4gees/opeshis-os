<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PaedsNursingNote;
use Illuminate\Support\Facades\Auth;

class LogPaedsNursingNoteAction
{
    public function execute(array $data): PaedsNursingNote
    {
        return PaedsNursingNote::create([
            'admission_id' => $data['admission_id'],
            'note' => $data['note'],
            'shift' => $data['shift'],
            'written_by' => Auth::id(),
        ]);
    }
}
