<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Opeshis;
use App\DTOs\UserDTO;

class AddUserAction
{
    /**
     * Authorize Institutional Personnel Registry Protocol
     */
    public function execute(UserDTO $dto): void
    {
        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password_hash' => Hash::make($dto->password),
            'role' => $dto->role,
            'sys_dept_id' => $dto->sysDeptId,
        ]);

        Opeshis::logAction(
            'ADMIN_USER_ADD',
            'users',
            $user->id,
            "Institutional Protocol: Personnel record established for: " . $dto->name
        );
    }
}
