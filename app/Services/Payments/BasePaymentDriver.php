<?php

namespace App\Services\Payments;

use App\Contracts\PaymentDriver;

abstract class BasePaymentDriver implements PaymentDriver
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    abstract public function requestPayment(float $amount, string $phone, string $reference, array $options = []): array;
    
    abstract public function checkStatus(string $externalId): array;

    abstract public function getName(): string;

    protected function formatPhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) === 9 && (strpos($phone, '6') === 0 || strpos($phone, '2') === 0)) {
            return '237' . $phone;
        }
        return $phone;
    }
}
