<?php

declare(strict_types=1);

namespace App\Actions\Finance;

use App\Models\InsuranceProvider;
use App\Helpers\Opeshis;

class AddInsuranceProviderAction
{
    public function execute(array $data): InsuranceProvider
    {
        $provider = InsuranceProvider::create([
            'name' => $data['name'],
            'contact_person' => $data['contact'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => 'active',
            'default_co_pay_rate' => $data['co_pay'] ?? 0,
        ]);

        Opeshis::logAction('BILLING_PROVIDER_ADD', 'insurance_providers', $provider->id, "Institutional Provider Enrollment: {$provider->name}");

        return $provider;
    }
}
