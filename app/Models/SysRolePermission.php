<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysRolePermission extends Model
{
    protected $table = 'sys_role_permissions';

    public $incrementing = false;
    public $timestamps = false;
    
    // Composite primary keys are tricky in Eloquent, but we mostly just query it.

    protected $fillable = [
        'role_name',
        'permission_code',
        'branch_id'
    ];

    public function role()
    {
        return $this->belongsTo(SysRole::class, 'role_name', 'name');
    }
}
