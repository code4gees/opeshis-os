<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabOrder;
use App\Models\LabOrderItem;
use App\Models\LabCatalog;
use App\Actions\Diagnostics\VerifyLabResultAction;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LabController extends Controller
{
    /**
     * Show the Institutional Diagnostic Command Center
     */
    public function index(Request $request): View
    {
        $tab = $request->query('subtab', 'analytics');
        $search = $request->query('search', '');

        $stats = [
            'pending' => LabOrder::where('status', 'pending')->count(),
            'collect' => LabOrder::where('status', 'pending')->whereNotNull('patient_id')->count(),
            'critical' => LabOrderItem::whereIn('flag', ['Critical', 'Abnormal'])->where('created_at', '>', now()->subDay())->count(),
            'today' => LabOrder::where('status', 'completed')->whereDate('updated_at', today())->count(),
        ];

        $data = [
            'tab' => $tab,
            'stats' => $stats,
            'search' => $search,
            'allCategories' => Cache::remember('sys_lab_catalog_categories', 3600, function() {
                return LabCatalog::distinct()->pluck('category');
            }),
        ];

        if ($tab === 'orders') {
            $data['pendingOrders'] = LabOrder::when(auth()->user()->branch_id, function ($query, $branchId) {
                    return $query->whereHas('patient', function ($q) use ($branchId) {
                        $q->where('branch_id', $branchId);
                    });
                })
                ->with('patient')
                ->where('status', 'pending')
                ->orderBy('created_at', 'asc')
                ->get();

        } elseif ($tab === 'history') {
            $data['history'] = LabOrder::when(auth()->user()->branch_id, function ($query, $branchId) {
                    return $query->whereHas('patient', function ($q) use ($branchId) {
                        $q->where('branch_id', $branchId);
                    });
                })
                ->with(['patient'])
                ->where('status', 'completed')
                ->orderBy('updated_at', 'desc')
                ->limit(100)
                ->get();

        } elseif ($tab === 'catalog') {
            $query = LabCatalog::query();
            if ($request->query('category')) {
                $query->where('category', $request->query('category'));
            }
            $data['catalog'] = $query->orderBy('category')->orderBy('name')->get();

        } elseif ($tab === 'analytics') {
            $data['dailyStats'] = LabOrder::select(DB::raw('date(updated_at) as date, count(*) as total'))
                ->where('status', 'completed')
                ->where('updated_at', '>', now()->subDays(7))
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get();
            
            $data['categoryVolume'] = LabOrderItem::with('test')
                ->select('test_id', DB::raw('count(*) as total'))
                ->groupBy('test_id')
                ->get()
                ->map(fn($item) => (object)[
                    'category' => $item->test->category ?? 'General',
                    'total' => $item->total
                ]);
        }

        return view('lab', $data);
    }

    /**
     * Handle Institutional Diagnostic Actions Protocol via Action
     */
    public function action(
        Request $request, 
        VerifyLabResultAction $verifyAction,
        \App\Actions\Diagnostics\CollectLabSampleAction $collectAction
    ): RedirectResponse {
        $action = $request->input('action');

        try {
            if ($action === 'collect_sample') {
                $collectAction->execute($request->input('order_id'));
                return redirect()->route('operations.diagnostics.lab.index', ['subtab' => 'orders'])->with('success', 'Institutional specimen collection authorized.');

            } elseif ($action === 'submit_results') {
                $verifyAction->execute($request->input('order_id'), $request->input('results'));
                return redirect()->route('operations.diagnostics.lab.index', ['subtab' => 'history'])->with('success', 'Institutional diagnostic results verified.');
            }
        } catch (\Exception $e) {
            return redirect()->route('operations.diagnostics.lab.index', ['subtab' => $request->input('action') === 'collect_sample' ? 'orders' : 'analytics'])->with('error', $e->getMessage());
        }

        return redirect()->route('operations.diagnostics.lab.index');
    }
}
