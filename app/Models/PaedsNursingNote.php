<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaedsNursingNote extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'paeds_nursing_notes';

    protected $fillable = [
        'admission_id',
        'note',
        'shift',
        'written_by'
    ];

    protected function note(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('note'); }

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'written_by');
    }
}
