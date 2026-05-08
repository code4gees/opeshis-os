<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PftSession;
use Illuminate\Support\Facades\Auth;

class FinalizePftReportAction
{
    public function execute(string $id, array $data): PftSession
    {
        $session = PftSession::findOrFail($id);
        $session->update([
            'interpretation' => $data['interpretation'],
            'recommendation' => $data['recommendation'],
            'reported_by' => Auth::id(),
            'reported_at' => now(),
        ]);
        return $session;
    }
}
