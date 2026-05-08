<?php

namespace App\Contracts;

interface PaymentDriver
{
    /**
     * Initiate a payment request (Pull/Push)
     */
    public function requestPayment(float $amount, string $phone, string $reference, array $options = []): array;

    /**
     * Check status of a transaction
     */
    public function checkStatus(string $externalId): array;

    /**
     * Get provider name
     */
    public function getName(): string;
}
