<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dhis2Reports;
use App\Models\Dhis2Config;
use App\Models\Patient;
use App\Models\ActiveQueue;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReportingController extends Controller
{
    /**
     * Show Reporting & DHIS2 Hub
     */
    public function index(): View
    {
        $this->ensureTablesExist();

        $reports = Dhis2Reports::with('generator')
            ->orderBy('created_at', 'desc')
            ->get();

        $config = Dhis2Config::first();

        return view('reporting.index', compact('reports', 'config'));
    }

    /**
     * Generate DHIS2 Report Payload
     */
    public function generate(Request $request): RedirectResponse
    {
        $period = $request->input('period', date('Y-\M m'));
        
        // Mocking DHIS2 aggregation logic based on existing clinical data
        $payload = [
            'period' => $period,
            'orgUnit' => 'Opeshis-Main-001',
            'dataValues' => [
                ['dataElement' => 'GEN-PAT-01', 'value' => Patient::whereDate('created_at', '>=', now()->startOfMonth())->count()],
                ['dataElement' => 'CLIN-ENC-05', 'value' => ActiveQueue::whereDate('created_at', '>=', now()->startOfMonth())->count()],
                ['dataElement' => 'DIAG-MAL-01', 'value' => MedicalRecord::where('provisional_diagnosis', 'ILIKE', '%malaria%')->count()],
            ]
        ];

        Dhis2Reports::create([
            'report_period' => $period,
            'report_type' => $request->input('type', 'HMIS-105'),
            'generated_by' => auth()->id(),
            'data_payload' => json_encode($payload),
            'status' => 'DRAFT',
        ]);

        return redirect()->back()->with('success', "Institutional report for $period generated.");
    }

    /**
     * Export to External DHIS2 Instance
     */
    public function exportDHIS2(Request $request): RedirectResponse
    {
        $reportId = $request->input('report_id');
        $report = Dhis2Reports::find($reportId);
        
        if (!$report) return redirect()->back()->with('error', 'Report not found.');

        $payload = json_decode($report->data_payload, true);
        
        $success = \App\Helpers\ExternalBridge::pushToDHIS2($report->report_period, $payload['dataValues']);

        if ($success) {
            $report->update(['status' => 'TRANSMITTED']);
            return redirect()->back()->with('success', 'Report transmitted to National DHIS2 instance.');
        }

        return redirect()->back()->with('error', 'Transmission failed. Check network or credentials.');
    }

    private function ensureTablesExist()
    {
        DB::statement("CREATE TABLE IF NOT EXISTS dhis2_config (id SERIAL PRIMARY KEY, instance_url TEXT, api_user TEXT, api_password TEXT, org_unit_id TEXT, is_active BOOLEAN DEFAULT TRUE)");
        DB::statement("CREATE TABLE IF NOT EXISTS dhis2_reports (id UUID PRIMARY KEY, report_period VARCHAR(20), report_type VARCHAR(50), generated_by UUID REFERENCES users(id), data_payload JSONB, status VARCHAR(20), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
        
        if (Dhis2Config::count() === 0) {
            Dhis2Config::insert([
                'instance_url' => 'https://dhis2.moh.gov.test',
                'api_user' => 'opeshis_sync',
                'api_password' => 'secret',
                'org_unit_id' => 'OU_12345'
            ]);
        }
    }
}
