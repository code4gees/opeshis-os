<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\SurveillanceContact;

class AddSurveillanceContactAction
{
    public function execute(array $data): SurveillanceContact
    {
        return SurveillanceContact::create([
            'case_id' => $data['case_id'],
            'contact_name' => $data['name'],
            'relationship' => $data['relationship'],
            'phone' => $data['phone'],
        ]);
    }
}
