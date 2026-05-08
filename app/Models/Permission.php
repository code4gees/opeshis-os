<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'sys_permissions';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['code', 'name', 'category', 'description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'sys_role_permissions', 'permission_code', 'role_name');
    }
}
