<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EndoscopyReport extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'endoscopy_reports';

    protected $fillable = [
        'booking_id',
        'macroscopic_findings',
        'microscopic_findings',
        'impression',
        'recommendations',
        'reported_by'
    ];

    protected function macroscopicFindings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('macroscopic_findings'); }
    protected function microscopicFindings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('microscopic_findings'); }
    protected function impression(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('impression'); }
    protected function recommendations(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('recommendations'); }

    public function booking()
    {
        return $this->belongsTo(EndoscopyBooking::class, 'booking_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}
