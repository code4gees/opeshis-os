<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TheatreAnaesthesiaDrug extends Model
{
    use HasUuids;

    protected $table = 'theatre_anaesthesia_drugs';

    protected $fillable = [
        'case_id',
        'drug_name',
        'dose',
        'route',
        'administered_at',
        'administered_by'
    ];

    public function case()
    {
        return $this->belongsTo(TheatreCase::class, 'case_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'administered_by');
    }
}
