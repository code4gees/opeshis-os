<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\DialysisSession;
use Illuminate\Support\Facades\Auth;

class AbortDialysisSessionAction
{
    public function execute(string $id, array $data): void
    {
        $session = DialysisSession::findOrFail($id);
        
        $session->update([
            'status' => 'aborted',
            'abort_reason' => $data['reason'],
            'aborted_at' => now(),
            'aborted_by' => Auth::id(),
        ]);
        
        $session->machine()->update(['status' => 'available']);
    }
}
