<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabOrder;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use App\Models\BillingInvoice;
use App\Models\Patient;
use App\Helpers\Opeshis;
use Illuminate\View\View;

class PrintController extends Controller
{
    /**
     * Generate Standardized Institutional Document
     */
    public function generate(string $type, string $id): View
    {
        $data = null;
        $title = "Institutional Document";

        try {
            switch ($type) {
                case 'lab':
                    $data = LabOrder::with('patient')->find($id);
                    $title = "Laboratory Investigation Report";
                    break;

                case 'clinical':
                    $data = MedicalRecord::with('patient')->find($id);
                    $title = "Clinical Consultation Summary";
                    break;

                case 'pharmacy':
                    $data = Prescription::with(['patient', 'inventoryItem'])->find($id);
                    $title = "Pharmaceutical Prescription";
                    break;

                case 'billing':
                    $data = BillingInvoice::with(['patient', 'insuranceProvider'])->find($id);
                    $title = "Institutional Billing Invoice";
                    break;

                default:
                    abort(404, "Unsupported document type.");
            }
        } catch (\Exception $e) {
            abort(500, "Integrity Error: " . $e->getMessage());
        }

        if (!$data) abort(404, "Record not found.");

        // Decrypt PII
        if ($data->patient && isset($data->patient->full_name)) {
            $data->patient->full_name = Opeshis::decryptPII($data->patient->full_name);
        }

        return view('print.layout', compact('data', 'type', 'title'));
    }

    /**
     * Generate Institutional Medical Passport
     */
    public function passport(string $id): View
    {
        $data = Patient::findOrFail($id);
        $data->full_name = Opeshis::decryptPII($data->full_name);
        $type = 'passport';
        $title = "Institutional Medical Passport";

        return view('print.passport', compact('data', 'type', 'title'));
    }
}
