<?php

namespace App\Contracts;

interface MessagingDriver
{
    /**
     * Send a message to a recipient
     * 
     * @param string $to
     * @param string $message
     * @param array $options
     * @return array ['success' => bool, 'id' => string, 'error' => string]
     */
    public function send(string $to, string $message, array $options = []): array;

    /**
     * Get the display name of the provider
     */
    public function getName(): string;
}
