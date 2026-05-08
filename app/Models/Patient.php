<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Helpers\Opeshis;

class Patient extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory, HasUuids, \App\Traits\ProtectsPII, \App\Traits\Auditable;

    protected $table = 'patients';

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('full_name') && $model->full_name) {
                $model->search_hash = \App\Helpers\Opeshis::generateSearchHash($model->full_name);
            }
        });
    }

    protected $fillable = [
        'medical_id',
        'full_name',
        'phone',
        'email',
        'password_hash',
        'gender',
        'dob',
        'blood_group',
        'genotype',
        'allergies',
        'address',
        'neighborhood',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'insurance_provider_id',
        'insurance_policy_number',
        'branch_id',
        'photo_path',
        'search_hash'
    ];

    /**
     * Institutional PII Protection: Automatic Encryption/Decryption
     */
    protected function fullName(): Attribute { return $this->castPII('full_name'); }
    protected function phone(): Attribute { return $this->castPII('phone'); }
    protected function email(): Attribute { return $this->castPII('email'); }
    protected function allergies(): Attribute { return $this->castPII('allergies'); }
    protected function address(): Attribute { return $this->castPII('address'); }
    protected function neighborhood(): Attribute { return $this->castPII('neighborhood'); }
    protected function emergencyContactPhone(): Attribute { return $this->castPII('emergency_contact_phone'); }
    protected function insurancePolicyNumber(): Attribute { return $this->castPII('insurance_policy_number'); }

    public function encounters()
    {
        return $this->hasMany(OpdEncounter::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
