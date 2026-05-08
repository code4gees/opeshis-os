<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysRole extends Model
{
    protected $table = 'sys_roles';

    // Disable auto-incrementing since the primary key is handled differently or we just use name as the primary key for the relationship.
    // Actually the primary key is `id` (integer) based on the schema, but the relationship in `users` maps `role` (string) to `name` (string) in `sys_roles`.
    
    protected $fillable = [
        'name',
        'description',
        'parent_role',
        'branch_id'
    ];

    public $timestamps = false; // schema only has created_at, no updated_at

    /**
     * Get the permissions associated with this role.
     */
    public function permissions()
    {
        return $this->hasMany(SysRolePermission::class, 'role_name', 'name');
    }
}
