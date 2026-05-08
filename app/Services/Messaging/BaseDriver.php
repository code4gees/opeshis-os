<?php

namespace App\Services\Messaging;

use App\Contracts\MessagingDriver;

abstract class BaseDriver implements MessagingDriver
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Normalize phone to E.164 format
     */
    protected function formatPhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        if (strpos($phone, '237') === 0) {
            return '+' . $phone;
        }

        if (preg_match('/^[62]/', $phone)) {
            return '+237' . $phone;
        }

        return '+' . $phone;
    }

    abstract public function send(string $to, string $message, array $options = []): array;
    
    abstract public function getName(): string;
}
