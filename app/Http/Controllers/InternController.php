<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DailyReport;
use App\Models\SiteSetting;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InternController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu belum melakukan Login');
        }

        $siteSettings = SiteSetting::firstOrFail();

        $user = Auth::user();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $attendanceSummary = $this->getAttendanceSummary($user->id);
        $tasksSummary = $this->getTasksSummary($user->id);
        $dailyReportsSummary = $this->getDailyReportsSummary($user->id);

        return view('magang.dashbord', compact('user', 'attendanceSummary', 'tasksSummary', 'dailyReportsSummary', 'siteSettings'));
    }

    public function attendance()
    {
        $user = Auth::user();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $siteSettings = SiteSetting::firstOrFail();

        $attendances = Attendance::where('user_id', $user->id)->get();

        return view('magang.attendance', compact('user', 'attendances', 'siteSettings'));
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        $siteSettings = SiteSetting::firstOrFail();

        return view('magang.edit-task', compact('task', 'siteSettings'));
    }

    public function completeTask($id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'completed' => true,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditandai sebagai selesai.');
    }

    public function checkIn(Request $request)
    {
        $user = Auth::user();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', Carbon::today()->toDateString())
            ->first();

        if ($attendance) {
            return redirect()->route('magang.attendance')->with('error', 'Anda sudah melakukan check-in hari ini!');
        } else {
            $newAttendance = new Attendance;
            $newAttendance->user_id = $user->id;
            $newAttendance->date = Carbon::today()->toDateString();
            $newAttendance->check_in_time = now();
            $newAttendance->save();

            return redirect()->route('magang.attendance')->with('success', 'Check-in berhasil!');
        }
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', Carbon::today()->toDateString())
            ->first();

        if ($attendance) {
            if (!$attendance->check_out_time) {
                $attendance->check_out_time = now();
                $attendance->save();

                return redirect()->route('magang.attendance')->with('success', 'Check-out berhasil!');
            } else {
                return redirect()->route('magang.attendance')->with('error', 'Anda sudah melakukan check-out hari ini!');
            }
        } else {
            return redirect()->route('magang.attendance')->with('error', 'Anda belum melakukan check-in hari ini!');
        }
    }

    public function attendanceHistory()
    {
        $user = Auth::user();
        $siteSettings = SiteSetting::firstOrFail();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $attendances = Attendance::where('user_id', $user->id)->get();

        return view('magang.attendance-history', compact('user', 'attendances', 'siteSettings'));
    }

    public function dailyReports()
    {
        $user = Auth::user();
        $siteSettings = SiteSetting::firstOrFail();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $dailyReports = DailyReport::where('user_id', $user->id)->get();

        return view('magang.daily-reports', compact('user', 'dailyReports', 'siteSettings'));
    }

    public function createDailyReport()
    {
        $user = Auth::user();
        $siteSettings = SiteSetting::firstOrFail();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        return view('magang.daily-reports-create', compact('user', 'siteSettings'));
    }

    public function storeDailyReport(Request $request)
    {
        $user = Auth::user();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $dailyReport = new DailyReport;
        $dailyReport->user_id = $user->id;
        $dailyReport->date = date('Y-m-d');
        $dailyReport->tasks_completed = $request->tasks_completed;
        $dailyReport->feedback = $request->feedback;
        $dailyReport->save();

        return redirect()->route('magang.daily-reports')->with('success', 'Daily report submitted!');
    }

    public function showDailyReport($reportId)
    {
        $dailyReport = DailyReport::find($reportId);
        $siteSettings = SiteSetting::firstOrFail();

        if (!$dailyReport) {
            return abort(404);
        }

        return view('magang.daily-reports-show', compact('dailyReport', 'siteSettings'));
    }

    public function editDailyReport($reportId)
    {
        $dailyReport = DailyReport::find($reportId);
        if (!$dailyReport) {
            return abort(404);
        }
        $siteSettings = SiteSetting::firstOrFail();

        return view('magang.daily-reports-edit', compact('dailyReport', 'siteSettings'));
    }

    public function updateDailyReport(Request $request, $reportId)
    {
        $dailyReport = DailyReport::find($reportId);
        if (!$dailyReport) {
            return abort(404);
        }

        $dailyReport->tasks_completed = $request->tasks_completed;
        $dailyReport->save();

        return redirect()->route('magang.daily-reports')->with('success', 'Daily report updated!');
    }

    public function tasks()
    {
        $user = Auth::user();
        $siteSettings = SiteSetting::firstOrFail();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $tasks = Task::where('user_id', $user->id)->get();

        return view('magang.tasks', compact('user', 'tasks', 'siteSettings'));
    }

    public function assignedTasks()
    {
        $user = Auth::user();
        $siteSettings = SiteSetting::firstOrFail();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $tasks = Task::where('user_id', $user->id)->where('completed', false)->get();

        return view('magang.tasks-assigned', compact('user', 'tasks', 'siteSettings'));
    }

    public function completedTasks()
    {
        $user = Auth::user();
        $siteSettings = SiteSetting::firstOrFail();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $tasks = Task::where('user_id', $user->id)->where('completed', true)->get();

        return view('magang.tasks-completed', compact('user', 'tasks', 'siteSettings'));
    }

    public function approachingDeadlineTasks()
    {
        $user = Auth::user();
        $siteSettings = SiteSetting::firstOrFail();

        if (!$user->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        $tasks = Task::where('user_id', $user->id)->where('due_date', '<', now()->addDays(7))->where('completed', false)->get();

        return view('magang.tasks-approaching-deadline', compact('user', 'tasks', 'siteSettings'));
    }

    public function profile()
    {
        $intern = Auth::user();
        $siteSettings = SiteSetting::firstOrFail();

        if (!$intern->hasRole('magang')) {
            return redirect()->route('login.admin')->withErrors('Email', 'Kamu tidak memiliki akses');
        }

        return view('magang.profile', compact('intern', 'siteSettings'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $siteSettings = SiteSetting::firstOrFail();

        return view('magang.profile-edit', compact('user', 'siteSettings'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'about_me' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'phone' => $request->phone,
            'about_me' => $request->about_me,
        ]);

        return redirect()->route('magang.profile')->with('success', 'Profile updated successfully.');
    }

    private function getAttendanceSummary($userId)
    {
        $attendance = Attendance::where('user_id', $userId)
            ->whereMonth('date', now()->month)
            ->get();

        $daysPresent = $attendance->count();
        $daysLate = $attendance->where('check_in_time', '>', '09:00:00')->count();

        $checkInTimes = $attendance->pluck('check_in_time')->map(function ($time) {
            return $this->timeToMinutes($time);
        });
        $checkOutTimes = $attendance->pluck('check_out_time')->map(function ($time) {
            return $this->timeToMinutes($time);
        });

        return [
            'total_present' => $daysPresent,
            'average_check_in_time' => $checkInTimes->average() ?? 'N/A',
            'average_check_out_time' => $checkOutTimes->average() ?? 'N/A',
        ];
    }

    private function timeToMinutes($time)
    {
        $parts = explode(':', $time);
        return ($parts[0] * 60) + $parts[1];
    }



    private function getTasksSummary($userId)
    {
        $tasks = Task::where('user_id', $userId)->get();

        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('completed', true)->count();
        $approachingDeadlineTasks = $tasks->where('duedate', '<', now()->addDays(3))->count();

        return [
            'total_tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
            'approaching_deadline_tasks' => $approachingDeadlineTasks,
        ];
    }

    private function getDailyReportsSummary($userId)
    {
        $dailyReports = DailyReport::where('user_id', $userId)
            ->whereMonth('date', now()->month)
            ->get();

        $totalReports = $dailyReports->count();
        $feedbackGiven = $dailyReports->whereNotNull('feedback')->count();

        return [
            'total_reports' => $totalReports,
            'feedback_given' => $feedbackGiven,
        ];
    }


}
