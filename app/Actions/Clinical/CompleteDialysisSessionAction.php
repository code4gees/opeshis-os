<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\DialysisSession;
use Illuminate\Support\Facades\Auth;

class CompleteDialysisSessionAction
{
    public function execute(string $id, array $data): void
    {
        $session = DialysisSession::findOrFail($id);
        
        $session->update([
            'post_weight' => $data['post_weight'],
            'uf_achieved' => $data['uf_achieved'],
            'kt_v' => $data['kt_v'],
            'complications' => $data['complications'] ?? null,
            'status' => 'completed',
            'completed_at' => now(),
            'completed_by' => Auth::id(),
        ]);
        
        $session->machine()->update(['status' => 'available']);
    }
}
