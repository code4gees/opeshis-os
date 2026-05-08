<?php

declare(strict_types=1);

namespace App\DTOs;

final readonly class ConsultationDTO
{
    public function __construct(
        public string $encounterId,
        public ?string $subjective,
        public ?string $objective,
        public ?string $assessment,
        public ?string $plan,
        public string $doctorId,
    ) {}
}
