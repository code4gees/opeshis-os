<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    // Benchmark Triage Active Queue Join
    $explainQueue = DB::select("
        EXPLAIN ANALYZE
        SELECT q.*, p.full_name, p.medical_id
        FROM active_queue q
        JOIN patients p ON q.patient_id = p.id
        WHERE q.status IN ('waiting', 'in_progress')
        ORDER BY q.created_at ASC
    ");

    echo "\n=== Triage Queue Benchmark ===\n";
    foreach ($explainQueue as $row) {
        echo $row->{'QUERY PLAN'} . "\n";
    }

    // Benchmark Billing Invoices Join
    $explainBilling = DB::select("
        EXPLAIN ANALYZE
        SELECT i.*, p.full_name, p.medical_id
        FROM billing_invoices i
        JOIN patients p ON i.patient_id = p.id
        WHERE i.status = 'unpaid'
        ORDER BY i.created_at DESC
    ");

    echo "\n=== Billing Invoices Benchmark ===\n";
    foreach ($explainBilling as $row) {
        echo $row->{'QUERY PLAN'} . "\n";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
