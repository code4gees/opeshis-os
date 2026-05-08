<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$roles = Illuminate\Support\Facades\DB::table('sys_role_permissions')
    ->select('role_name', 'permission_code')
    ->get()
    ->groupBy('role_name');

foreach ($roles as $role => $perms) {
    echo "$role: " . implode(', ', $perms->pluck('permission_code')->toArray()) . "\n";
}
