<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AuditLog extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'sys_audit_log';
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'details' => 'array',
    ];

    /**
     * Institutional PII Protection for Forensic Details
     */
    protected function details(): Attribute
    {
        return $this->castPII('details');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
