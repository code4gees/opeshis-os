<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class StaffCredential extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'staff_credentials';
    protected $guarded = [];

    /**
     * Institutional PII Protection
     */
    protected function credentialNumber(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return $this->castPII('credential_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
