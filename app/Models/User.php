<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password_hash',
        'role',
        'branch_id',
        'phone',
        'staff_code'
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    /**
     * Institutional PII Protection
     */
    protected function phone(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return $this->castPII('phone');
    }

    /**
     * Override the password field for authentication.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'password_hash' => 'hashed',
        ];
    }

    /**
     * Relationship to the System Role
     */
    public function sysRole()
    {
        return $this->belongsTo(Role::class, 'role', 'name');
    }

    /**
     * Relationship to the System Department
     */
    public function department()
    {
        return $this->belongsTo(SysDepartment::class, 'sys_dept_id', 'id');
    }

    /**
     * Institutional Permission Checker (High-Performance Caching)
     */
    public function hasPermission($permissionCode)
    {
        return \Illuminate\Support\Facades\Cache::remember(
            "user_perm_{$this->id}_{$permissionCode}",
            now()->addMinutes(60),
            function () use ($permissionCode) {
                // 1. Administrative Bypass
                if (in_array($this->role, ['Admin', 'SuperAdmin', 'System Core'])) {
                    return true;
                }

                // 2. Direct Role Permission Check
                $hasDirect = false;
                if ($this->sysRole) {
                    $hasDirect = \Illuminate\Support\Facades\Cache::remember(
                        "role_perm_{$this->role}_{$permissionCode}",
                        now()->addHours(12),
                        function () use ($permissionCode) {
                            return $this->sysRole->permissions()
                                ->where('permission_code', $permissionCode)
                                ->exists();
                        }
                    );
                }

                if ($hasDirect) return true;

                // 3. Clinical Fallback (Ensure medical staff have core access)
                if ($permissionCode === 'module_clinical') {
                    $clinicalRoles = ['doctor', 'nurse', 'midwife', 'surgeon', 'paediatrician', 'specialist'];
                    if (in_array(trim(strtolower($this->role ?? '')), $clinicalRoles)) {
                        return true;
                    }
                }

                return false;
            }
        );
    }

    /**
     * Relationship to Training Attendance
     */
    public function trainingAttendances()
    {
        return $this->hasMany(TrainingAttendance::class, 'staff_id');
    }
}
