<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaedsOrder extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'paeds_orders';

    protected $fillable = [
        'admission_id',
        'order_type',
        'order_text',
        'priority',
        'status',
        'ordered_by',
        'acknowledged_by',
        'acknowledged_at',
        'completed_by',
        'completed_at',
        'completion_notes'
    ];

    protected function orderText(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('order_text'); }
    protected function completionNotes(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('completion_notes'); }

    public function admission()
    {
        return $this->belongsTo(PaedsAdmission::class, 'admission_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'ordered_by');
    }
}
