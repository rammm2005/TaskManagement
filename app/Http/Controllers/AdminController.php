<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Attendance;
use App\Models\DailyReport;
use App\Models\MontlyReport;
use App\Models\SiteSetting;
use App\Models\Task;
use App\Models\User;
use App\Models\Department;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $siteSettings = SiteSetting::firstOrFail();
        $internsCount = User::role('magang')->count();
        $supervisorsCount = User::role('supervisor')->count();
        $adminsCount = User::role('admin')->count();
        $attendancesCount = Attendance::count();
        $dailyReportsCount = DailyReport::count();
        $tasksCount = Task::count();
        $departmentsCount = Department::count();

        return view('admin.dashboard', compact('internsCount', 'supervisorsCount', 'adminsCount', 'attendancesCount', 'dailyReportsCount', 'tasksCount', 'departmentsCount', 'siteSettings'));
    }

    public function userManagement()
    {
        $siteSettings = SiteSetting::firstOrFail();
        $interns = User::role('magang')->with('department')->get();
        $supervisors = User::role('supervisor')->with('department')->get();
        $admins = User::role('admin')->with('department')->get();
        $userAll = User::all();

        return view('admin.management', compact('interns', 'supervisors', 'admins', 'userAll', 'siteSettings'));
    }

    public function createUser($role)
    {
        $siteSettings = SiteSetting::firstOrFail();
        $departments = Department::all();
        return view('user.create-user', compact('departments', 'role', 'siteSettings'));
    }

    public function storeUser(Request $request, $role)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'phone' => 'nullable|string',
                'location' => 'nullable|string',
                'department_id' => 'nullable|exists:departments,id',
                'about_me' => 'nullable|string',
                'status' => 'required|in:active,inactive,blocked',
            ]);

            $status = $request->input('status');

            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = bcrypt($validatedData['password']);
            $user->phone = $validatedData['phone'];
            $user->location = $validatedData['location'];
            $user->department_id = $validatedData['department_id'];
            $user->status = $status;
            $user->about_me = $validatedData['about_me'];
            $user->save();

            // Assign role to user
            $user->assignRole($role);

            return redirect()->route('admin.userManagement')->with('success', ucfirst($role) . ' created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function editUser($role, $userId)
    {
        $siteSettings = SiteSetting::firstOrFail();
        $user = User::find($userId);
        if (!$user || !$user->hasRole($role)) {
            return abort(404);
        }
        $departments = Department::all();
        return view('user.edit-user', compact('user', 'departments', 'role', 'siteSettings'));
    }

    public function updateUser(Request $request, $role, $userId)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'about_me' => 'nullable|string',
            'status' => 'required|in:active,inactive,blocked',
        ]);

        $user = User::find($userId);
        if (!$user || !$user->hasRole($role)) {
            return abort(404);
        }

        $status = $request->input('status');

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->location = $validatedData['location'];
        $user->department_id = $validatedData['department_id'];
        $user->about_me = $validatedData['about_me'];
        $user->status = $status;
        $user->save();

        return redirect()->route('admin.userManagement')->with('success', ucfirst($role) . ' updated successfully!');
    }

    public function show($userId)
    {
        $siteSettings = SiteSetting::firstOrFail();
        $user = User::findOrFail($userId);
        return view('user.show-user', compact('user', 'siteSettings'));
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return abort(404);
        }

        $user->delete();

        return redirect()->route('admin.userManagement')->with('success', 'User deleted successfully!');
    }

    public function attendanceSummary()
    {
        $siteSettings = SiteSetting::firstOrFail();
        $attendances = Attendance::with('user')->get();
        return view('admin.attendance.view', compact('attendances', 'siteSettings'));
    }

    public function Reports()
    {
        $reports = MontlyReport::with('user')->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('admin.reports.monthly.monthly-reports', compact('reports', 'siteSettings'));
    }

    public function monthlyReports()
    {
        $reports = DailyReport::with('user')->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('admin.reports.daily.view', compact('reports', 'siteSettings'));
    }

    public function createMonthly()
    {
        $siteSettings = SiteSetting::firstOrFail();
        return view('admin.reports.monthly.create', compact('siteSettings'));
    }

    public function storeMonthly(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'month_year' => 'required',
                'content' => 'required|string',
            ]);

            $user = Auth::user();

            $monthlyReport = new MontlyReport();
            $monthlyReport->month_year = $validatedData['month_year'];
            $monthlyReport->user_id = $user->id;
            $monthlyReport->content = $validatedData['content'];
            $monthlyReport->save();

            return redirect()->route('monthly-reports.index')->with('success', 'Laporan bulanan berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan laporan bulanan: ' . $e->getMessage()]);
        }
    }

    public function editMonthly($id)
    {
        $report = MontlyReport::findOrFail($id);
        $siteSettings = SiteSetting::firstOrFail();

        return view('admin.reports.monthly.edit', compact('report', 'siteSettings'));
    }

    public function updateMonthly(Request $request, $id)
    {
        try {
            $request->validate([
                'month_year' => 'required',
                'content' => 'required|string',
            ]);

            $report = MontlyReport::findOrFail($id);
            $report->update([
                'month_year' => $request->month_year,
                'content' => $request->content,
            ]);

            return redirect()->route('monthly-reports.index')->with('success', 'Laporan bulanan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memperbarui laporan bulanan. Silakan coba lagi.']);
        }
    }

    public function destroyMonthly($id)
    {
        try {
            $report = MontlyReport::findOrFail($id);
            $report->delete();
            return redirect()->route('monthly-reports.index')->with('success', 'Laporan bulanan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus laporan bulanan. Silakan coba lagi.']);
        }
    }

    public function manageTasks()
    {
        $tasks = Task::all();
        $siteSettings = SiteSetting::firstOrFail();

        return view('admin.task.manage-task', compact('tasks', 'siteSettings'));
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        $siteSettings = SiteSetting::firstOrFail();

        return view('admin.edit-task', compact('task', 'siteSettings'));
    }

    public function updateTask(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'task_description' => 'required|string',
            'due_date' => 'required|date',
            'completed' => 'required|boolean',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->route('admin.manage-tasks')->with('success', 'Tugas berhasil diperbarui');
    }

    public function completeTask($id)
    {
        $task = Task::findOrFail($id);
        $task->completed = true;
        $task->save();

        return redirect()->route('admin.manage-tasks')->with('success', 'Tugas berhasil ditandai sebagai selesai');
    }
}
