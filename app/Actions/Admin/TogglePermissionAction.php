<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\Role;
use App\Models\Permission;
use App\Helpers\Opeshis;

class TogglePermissionAction
{
    /**
     * Authorize Institutional Permission Toggle Protocol
     */
    public function execute(string $roleName, string $permCode, bool $enabled): void
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $permission = Permission::where('permission_code', $permCode)->firstOrFail();

        if ($enabled) {
            $role->permissions()->syncWithoutDetaching([$permission->id]);
        } else {
            $role->permissions()->detach($permission->id);
        }

        Opeshis::logAction(
            'ADMIN_PERM_TOGGLE',
            'sys_role_permissions',
            $roleName . ':' . $permCode,
            "Institutional Protocol: Permission {$permCode} " . ($enabled ? 'enabled' : 'disabled') . " for role {$roleName}"
        );
    }
}
