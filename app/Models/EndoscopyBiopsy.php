<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EndoscopyBiopsy extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'endoscopy_biopsies';

    protected $fillable = [
        'booking_id',
        'site',
        'number_of_pieces',
        'sent_to_histology',
        'recorded_by'
    ];

    protected function site(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('site'); }

    public function booking()
    {
        return $this->belongsTo(EndoscopyBooking::class, 'booking_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
