<?php

declare(strict_types=1);

namespace App\DTOs;

final readonly class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $role,
        public string $sysDeptId,
    ) {}
}
