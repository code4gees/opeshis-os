<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\ChwHousehold;
use App\Helpers\Opeshis;

class RegisterChwHouseholdAction
{
    /**
     * Authorize Institutional Household Census
     */
    public function execute(array $data): ChwHousehold
    {
        $household = ChwHousehold::create($data);

        Opeshis::logAction('CHW_HOUSEHOLD_REG', 'chw_households', $household->id, "Protocol: Community household registered.");

        return $household;
    }
}
