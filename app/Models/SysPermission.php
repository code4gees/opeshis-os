<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysPermission extends Model
{
    protected $table = 'sys_permissions';

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'name',
        'category',
        'description'
    ];

    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(SysRole::class, 'sys_role_permissions', 'permission_code', 'role_name', 'code', 'name');
    }
}
