<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;

class StartNeonatalPhototherapyAction
{
    public function execute(string $id): void
    {
        Admission::findOrFail($id)->update([
            'phototherapy' => true, 
            'phototherapy_started_at' => now()
        ]);
    }
}
