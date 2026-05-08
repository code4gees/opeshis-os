<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingCourses;
use App\Models\TrainingSessions;
use App\Models\TrainingAttendance;
use App\Models\TrainingCertifications;
use App\Models\TrainingNeeds;
use App\Models\User;
use App\Actions\Admin\CreateTrainingCourseAction;
use App\Actions\Admin\ScheduleTrainingSessionAction;
use App\Actions\Admin\RecordTrainingAttendanceAction;
use App\Actions\Admin\AddTrainingCertificationAction;
use App\Actions\Admin\AddTrainingNeedAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class TrainingController extends Controller
{
    /**
     * Institutional Personnel Training & Compliance Dashboard
     */
    public function index(): View
    {
        $courses = TrainingCourses::orderBy('created_at', 'desc')->get();
        
        $sessions = TrainingSessions::with('course')
            ->orderBy('session_date', 'desc')
            ->get();
            
        $compliance = User::withCount('trainingAttendances as sessions_attended')
            ->has('trainingAttendances')
            ->get();

        return view('admin.training', compact('courses', 'sessions', 'compliance'));
    }

    /**
     * Authorize Institutional Training Course via Action
     */
    public function createCourse(Request $request, CreateTrainingCourseAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'target_role' => 'nullable|string',
            'mandatory' => 'nullable|string',
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional training course authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Schedule Institutional Training Session via Action
     */
    public function createSession(Request $request, ScheduleTrainingSessionAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'course_id' => 'required|uuid|exists:training_courses,id',
            'facilitator' => 'required|string',
            'venue' => 'required|string',
            'date' => 'required|date',
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional training session scheduled.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Training Attendance via Action
     */
    public function recordAttendance(Request $request, RecordTrainingAttendanceAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'session_id' => 'required|uuid|exists:training_sessions,id',
            'staff_ids' => 'required|array',
            'staff_ids.*' => 'uuid|exists:users,id',
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional attendance protocol committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Personnel Certification via Action
     */
    public function addCertification(Request $request, AddTrainingCertificationAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'issuing_body' => 'required|string',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date',
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Personnel certification record authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Personnel Training Need via Action
     */
    public function addNeed(Request $request, AddTrainingNeedAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'description' => 'required|string',
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Personnel training need identified and recorded.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Retrieve Institutional Compliance Intelligence
     */
    public function getCompliance(): JsonResponse
    {
        $data = User::withCount('trainingAttendances as sessions_attended')
            ->has('trainingAttendances')
            ->select('id', 'name')
            ->get();
            
        return response()->json($data);
    }
}
