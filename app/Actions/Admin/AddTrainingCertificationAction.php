<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\TrainingCertifications;
use Illuminate\Support\Facades\Auth;

class AddTrainingCertificationAction
{
    public function execute(array $data): TrainingCertifications
    {
        return TrainingCertifications::create([
            'user_id' => Auth::id(),
            'certification_name' => $data['name'],
            'issuing_body' => $data['issuing_body'],
            'issue_date' => $data['issue_date'],
            'expiry_date' => $data['expiry_date'] ?? null,
        ]);
    }
}
