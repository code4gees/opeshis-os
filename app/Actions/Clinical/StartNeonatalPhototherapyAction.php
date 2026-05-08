<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\NicuAdmission;

class StartNeonatalPhototherapyAction
{
    public function execute(string $id): void
    {
        NicuAdmission::findOrFail($id)->update([
            'phototherapy' => true, 
            'phototherapy_started_at' => now()
        ]);
    }
}
