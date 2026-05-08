<?php

namespace App\Traits;

use App\Helpers\Opeshis;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait ProtectsPII
{
    /**
     * Define PII fields for the model.
     * Overwrite this in the model if different fields are needed.
     */
    protected function piiFields(): array
    {
        return $this->pii_fields ?? [];
    }

    /**
     * Initialize the trait by creating dynamic accessors/mutators.
     * Note: This is a simplified version. For full automation, 
     * we would use the model's 'init' or boot method.
     */
    protected function castPII($field): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Opeshis::decryptPII($value),
            set: fn ($value) => Opeshis::encryptPII($value),
        );
    }
}
