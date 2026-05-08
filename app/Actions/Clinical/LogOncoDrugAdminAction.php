<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\OncoDrugAdmin;
use Illuminate\Support\Facades\Auth;

class LogOncoDrugAdminAction
{
    public function execute(array $data): OncoDrugAdmin
    {
        return OncoDrugAdmin::create([
            'plan_id' => $data['plan_id'],
            'drug_name' => $data['drug'],
            'dose' => $data['dose'],
            'unit' => $data['unit'],
            'route' => $data['route'],
            'cycle_number' => $data['cycle'],
            'administered_by' => Auth::id(),
            'administered_at' => now(),
        ]);
    }
}
