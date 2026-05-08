<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerformanceCycle;
use App\Models\PerformanceReview;
use App\Models\PerformanceSelfAssessment;
use App\Models\User;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class PerformanceController extends Controller
{
    /**
     * Institutional Personnel Performance Dashboard
     */
    public function index(): View
    {
        $cycles = PerformanceCycle::orderBy('start_date', 'desc')->get();
        
        $reviews = PerformanceReview::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->whereHas('staff', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->with(['staff'])
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        $stats = PerformanceCycle::selectRaw("count(*) as total, sum(case when status='active' then 1 else 0 end) as active")
            ->first();

        return view('admin.performance', compact('cycles', 'reviews', 'stats'));
    }

    /**
     * Authorize Institutional Performance Cycle Protocol
     */
    public function createCycle(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $cycle = PerformanceCycle::create([
            'name' => $validated['name'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'active',
            'created_by' => auth()->id(),
        ]);

        Opeshis::logAction('PERF_CYCLE', 'perf_cycles', $cycle->id, "Protocol: Performance cycle '{$validated['name']}' authorized.");
        
        return redirect()->back()->with('success', 'Institutional performance cycle authorized.');
    }

    /**
     * Commit Institutional Personnel Self-Assessment
     */
    public function submitSelfAssessment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cycle_id' => 'required|uuid|exists:perf_cycles,id',
            'achievements' => 'required|string',
            'challenges' => 'required|string',
            'goals' => 'required|string',
            'rating' => 'required|numeric|between:1,5',
        ]);

        PerformanceSelfAssessment::create([
            'cycle_id' => $validated['cycle_id'],
            'staff_id' => auth()->id(),
            'achievements' => $validated['achievements'],
            'challenges' => $validated['challenges'],
            'goals' => $validated['goals'],
            'self_rating' => $validated['rating'],
        ]);

        return redirect()->back()->with('success', 'Institutional self-assessment submitted.');
    }

    /**
     * Authorize Institutional Supervisor Review Protocol
     */
    public function completeReview(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cycle_id' => 'required|uuid|exists:perf_cycles,id',
            'staff_id' => 'required|uuid|exists:users,id',
            'rating' => 'required|numeric|between:1,5',
            'strengths' => 'required|string',
            'improvements' => 'required|string',
            'comments' => 'nullable|string',
        ]);

        $review = PerformanceReview::create([
            'cycle_id' => $validated['cycle_id'],
            'staff_id' => $validated['staff_id'],
            'overall_rating' => $validated['rating'],
            'strengths' => $validated['strengths'],
            'improvements' => $validated['improvements'],
            'comments' => $validated['comments'],
            'reviewed_by' => auth()->id(),
            'status' => 'pending_sign',
        ]);

        Opeshis::logAction('PERF_REVIEW', 'perf_reviews', $review->id, "Protocol: Performance review finalized. Rating: {$validated['rating']}");
        
        return redirect()->back()->with('success', 'Institutional performance review completed.');
    }

    /**
     * Authorize Institutional Review Sign-off Protocol
     */
    public function signReview(Request $request, string $id): RedirectResponse
    {
        PerformanceReview::findOrFail($id)->update([
            'status' => 'signed',
            'staff_signed_at' => now(),
            'staff_comments' => $request->input('comments')
        ]);

        return redirect()->back()->with('success', 'Institutional performance review signed.');
    }

    /**
     * Retrieve Institutional Performance Intelligence
     */
    public function getStats(): JsonResponse
    {
        $stats = [
            'avg_rating' => PerformanceReview::avg('overall_rating'),
            'reviews_pending_sign' => PerformanceReview::where('status', 'pending_sign')->count(),
            'reviews_signed' => PerformanceReview::where('status', 'signed')->count()
        ];
        
        return response()->json($stats);
    }
}
