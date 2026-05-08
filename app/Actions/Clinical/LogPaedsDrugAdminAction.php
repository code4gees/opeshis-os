<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PaedsDrugAdmin;
use Illuminate\Support\Facades\Auth;

class LogPaedsDrugAdminAction
{
    public function execute(array $data): PaedsDrugAdmin
    {
        return PaedsDrugAdmin::create([
            'admission_id' => $data['admission_id'],
            'drug_name' => $data['drug'],
            'dose' => $data['dose'],
            'route' => $data['route'],
            'administered_by' => Auth::id(),
            'administered_at' => now(),
        ]);
    }
}
