<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Institutional Forensic Observation Protocol is now handled 
        // via the \App\Traits\Auditable trait in individual models.
    }
}
