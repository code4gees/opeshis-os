<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Helpers\Opeshis;

class TriggerBackupAction
{
    public function execute(): void
    {
        // Future: actually dispatch a backup job
        Opeshis::logAction(
            'ADMIN_BACKUP_TRIGGER', 
            'system', 
            null, 
            'Institutional backup manual trigger.'
        );
    }
}
