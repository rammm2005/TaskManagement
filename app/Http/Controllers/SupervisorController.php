<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\DailyReport;
use App\Models\Task;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{
    public function dashboard()
    {
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $interns = $supervisor->interns;

        $attendanceSummary = $this->getAttendanceSummary($supervisor->id);
        $tasksSummary = $this->getTasksSummary($supervisor->id);

        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.dashboard', compact('supervisor', 'interns', 'attendanceSummary', 'tasksSummary', 'siteSettings'));
    }

    public function interns()
    {
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $interns = $supervisor->interns;
        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.intern', compact('supervisor', 'interns', 'siteSettings'));
    }

    public function tasksBySupervisor()
    {
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $tasks = Task::where('supervisor_id', $supervisor->id)
            ->with('user')
            ->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.intern-tasks', compact('supervisor', 'tasks', 'siteSettings'));
    }

    public function showIntern($internId)
    {
        $intern = User::findOrFail($internId);
        $supervisor = Auth::user();

        if (!$intern || (!$intern->hasRole('magang') && !$intern->hasRole('supervisor'))) {
            abort(404);
        }

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.show_interns', compact('intern', 'siteSettings'));
    }

    public function internAttendance($internId)
    {
        $intern = User::findOrFail($internId);
        $supervisor = Auth::user();

        if (!$intern || (!$intern->hasRole('magang') && !$intern->hasRole('supervisor'))) {
            abort(404);
        }

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $attendances = Attendance::where('user_id', $intern->id)->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.intern-attendance', compact('intern', 'attendances', 'siteSettings'));
    }

    public function internDailyReports($internId)
    {
        $intern = User::findOrFail($internId);
        $supervisor = Auth::user();

        if (!$intern || (!$intern->hasRole('magang') && !$intern->hasRole('supervisor'))) {
            abort(404);
        }

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $dailyReports = DailyReport::where('user_id', $intern->id)->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.intern-daily-reports', compact('intern', 'dailyReports', 'siteSettings'));
    }

    public function internTasks($internId)
    {
        $intern = User::findOrFail($internId);
        $supervisor = Auth::user();

        if (!$intern || (!$intern->hasRole('magang') && !$intern->hasRole('supervisor'))) {
            abort(404);
        }

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $tasks = Task::where('user_id', $intern->id)->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.intern-tasks', compact('intern', 'tasks', 'siteSettings'));
    }

    public function assignedTasks()
    {
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $tasks = Task::where('supervisor_id', $supervisor->id)
            ->where('completed', false)
            ->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.tasks-assigned', compact('supervisor', 'tasks', 'siteSettings'));
    }

    public function completedTasks()
    {
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $tasks = Task::where('supervisor_id', $supervisor->id)->where('completed', true)->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.tasks-completed', compact('supervisor', 'tasks', 'siteSettings'));
    }

    public function approachingDeadlineTasks()
    {
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $tasks = Task::where('supervisor_id', $supervisor->id)
            ->where('duedate', '<', now()->addDays(7))
            ->where('completed', false)
            ->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('supervisor.tasks-approaching-deadline', compact('supervisor', 'tasks', 'siteSettings'));
    }

    public function createTask()
    {
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $siteSettings = SiteSetting::firstOrFail();
        $interns = $supervisor->interns;

        return view('supervisor.create-task', compact('siteSettings', 'interns'));
    }

    public function storeTask(Request $request)
    {
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'task_description' => 'required|string',
            'duedate' => 'required|date',
            'intern_id' => 'required|exists:users,id',
        ]);

        Task::create([
            'name' => $request->name,
            'task_description' => $request->task_description,
            'duedate' => $request->duedate,
            'supervisor_id' => $supervisor->id,
            'user_id' => $request->intern_id,
            'completed' => false,
        ]);

        return redirect()->route('supervisor.tasks-assigned')->with('success', 'Task created successfully.');
    }

    public function editTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        if ($task->supervisor_id !== $supervisor->id) {
            abort(403);
        }

        $siteSettings = SiteSetting::firstOrFail();
        $interns = User::role('magang')->get();

        return view('supervisor.task-edit', compact('task', 'interns', 'siteSettings'));
    }

    public function updateTask(Request $request, $taskId)
    {
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'task_description' => 'required|string',
            'duedate' => 'required|date',
            'intern_id' => 'required|exists:users,id',
        ]);

        $task = Task::findOrFail($taskId);

        if ($task->supervisor_id !== $supervisor->id) {
            abort(403);
        }

        $intern = User::findOrFail($request->intern_id);

        if (!$intern->hasRole('magang')) {
            return redirect()->back()->withErrors('intern_id', 'Selected user is not an intern.');
        }

        $task->update([
            'name' => $request->name,
            'task_description' => $request->task_description,
            'duedate' => $request->duedate,
            'user_id' => $request->intern_id,
            'completed' => $request->has('completed') ? $request->completed : false,
        ]);

        return redirect()->route('supervisor.tasks-assigned')->with('success', 'Task updated successfully.');
    }


    public function deleteTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $supervisor = Auth::user();

        if (!$supervisor->hasRole('supervisor')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        if ($task->supervisor_id !== $supervisor->id) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('supervisor.tasks-assigned')->with('success', 'Task deleted successfully.');
    }

    // Helper methods to get attendance and tasks summary
    private function getAttendanceSummary($supervisorId)
    {
        $interns = User::whereHas('roles', function ($query) {
            $query->where('name', 'magang');
        })->where('supervisor_id', $supervisorId)->pluck('id');

        $attendanceSummary = Attendance::whereIn('user_id', $interns)
            ->selectRaw('count(*) as total, user_id')
            ->groupBy('user_id', )
            ->get();

        return $attendanceSummary;
    }

    private function getTasksSummary($supervisorId)
    {
        $tasksSummary = Task::where('supervisor_id', $supervisorId)
            ->selectRaw('count(*) as total, completed')
            ->groupBy('completed')
            ->get()
            ->pluck('total', 'completed');

        return $tasksSummary;
    }
}
