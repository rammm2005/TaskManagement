<?php

//tambahan gpt
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SystemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

    // Route::get('/', [HomeController::class, 'home']);
    // Route::get('dashboard', function () {
    // 	return view('dashboard');
    // })->name('dashboard');

    Route::get('billing', function () {
        return view('billing');
    })->name('billing');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');

    Route::get('user-management', function () {
        return view('laravel-examples/user-management');
    })->name('user-management');

    Route::get('tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('virtual-reality', function () {
        return view('virtual-reality');
    })->name('virtual-reality');

    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');

    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');

    // Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    // Route::get('/login', function () {
    // 	return view('dashboard');
    // })->name('sign-up');
});





Route::middleware('auth:web')->prefix('magang')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('magang.dashboard');
    // Route::resources('attandance', );
});



Route::middleware('auth:supervisor')->prefix('supervisior')->group(function () {
    Route::get('dashboard', function () {
        return view('supervisor/dashboard');
    })->name('supervisor.dashboard');
    // Route::resources('attandance', );
});

// Route::middleware('auth:admin')->prefix('admin')->group(function () {
//     Route::get('dashboard', function () {
//         return view('admin/dashboard');
//     })->name('admin.dashboard');
//     // Route::resources('attandance', );
// });



// Route::group(['middleware' => 'guest'], function () {
//     // Route::get('/register/user', [RegisterController::class, 'create']);
//     // Route::get('/register/user', [RegisterController::class, 'create']);
//     // Route::post('/register', [RegisterController::class, 'store']);
//     // Route::get('/login/supervisor', [SessionsController::class, 'create'])->name('login.supervisor');
//     // Route::get('/login/magang', [SessionsController::class, 'createMagang'])->name('login.magang');
//     Route::get('auth/login', [SessionsController::class, 'createAdmin'])->name('login.admin');
//     // Route::post('/session/supervisor', [SessionsController::class, 'store'])->name('supervisor.login');
//     // Route::post('/session/magang', [SessionsController::class, 'storeMagang'])->name('magang.login');
//     Route::post('/session/admin', [SessionsController::class, 'storeAdmin'])->name('admin.login');
//     // Route::post('/logout/supervisor', [SessionsController::class, 'destroy'])->name('supervisor.logout');
//     // Route::post('/logout/magang', [SessionsController::class, 'destroyMagang'])->name('magang.logout');

//     // Route::get('/login/forgot-password', [ResetController::class, 'create']);
//     // Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
//     // Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
//     // Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

// });

// Login untuk semuanya
Route::get('auth/login', [SessionsController::class, 'createAdmin'])->name('login.admin');
Route::post('/session/admin', [SessionsController::class, 'storeAdmin'])->name('admin.login');

// Route::get('/login', function () {
//     return view('session/login-session');
// })->name('login');

//gpt pake yang ni ?
// Route::get('/intern/dashboard', [InternController::class, 'dashboard']);
// Route::get('/intern/attendance', [InternController::class, 'attendance']);
// Route::post('/intern/check-in', [InternController::class, 'checkIn']);
// Route::post('/intern/check-out', [InternController::class, 'checkOut']);
// Route::get('/intern/attendance-history', [InternController::class, 'attendanceHistory']);
// Route::get('/intern/daily-reports', [InternController::class, 'dailyReports']);
// Route::get('/intern/create-daily-report', [InternController::class, 'createDailyReport']);
// Route::post('/intern/store-daily-report', [InternController::class, 'storeDailyReport']);
// Route::get('/intern/show-daily-report/{id}', [InternController::class, 'showDailyReport']);
// Route::get('/intern/edit-daily-report/{id}', [InternController::class, 'editDailyReport']);
// Route::post('/intern/update-daily-report/{id}', [InternController::class, 'updateDailyReport']);
// Route::get('/intern/daily-reports-history', [InternController::class, 'dailyReportsHistory']);
// Route::get('/intern/tasks', [InternController::class, 'tasks']);
// Route::get('/intern/assigned-tasks', [InternController::class, 'assignedTasks']);
// Route::get('/intern/completed-tasks', [InternController::class, 'completedTasks']);
// Route::get('/intern/approaching-deadline-tasks', [InternController::class, 'approachingDeadlineTasks']);
// Route::get('/intern/profile', [InternController::class, 'profile']);
// Route::get('/intern/edit-profile', [InternController::class, 'editProfile']);
// Route::post('/intern/update-profile', [InternController::class, 'updateProfile']);

// Route::get('/supervisor/dashboard', [SupervisorController::class, 'dashboard']);
// Route::get('/supervisor/interns', [SupervisorController::class, 'interns']);
// Route::get('/supervisor/show-intern/{id}', [SupervisorController::class, 'showIntern']);
// Route::get('/supervisor/intern-attendance/{id}', [SupervisorController::class, 'internAttendance']);
// Route::get('/supervisor/intern-daily-reports/{id}', [SupervisorController::class, 'internDailyReports']);
// Route::get('/supervisor/intern-tasks/{id}', [SupervisorController::class, 'internTasks']);
// Route::get('/supervisor/assigned-tasks', [SupervisorController::class, 'assignedTasks']);
// Route::get('/supervisor/completed-tasks', [SupervisorController::class, 'completedTasks']);
// Route::get('/supervisor/approaching-deadline-tasks', [SupervisorController::class, 'approachingDeadlineTasks']);

// Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
// Route::get('/admin/user-management', [AdminController::class, 'userManagement']);
// Route::get('/admin/attendance-management', [AdminController::class, 'attendanceManagement']);
// Route::get('/admin/report-management', [AdminController::class, 'reportManagement']);
// Route::get('/admin/task-management', [AdminController::class, 'taskManagement']);
// Route::get('/admin/department-management', [AdminController::class, 'departmentManagement']);
// Route::get('/admin/system-settings', [AdminController::class, 'systemSettings']);


Route::middleware(['auth', 'role:magang'])->prefix('intern')->group(function () {
    Route::get('dashboard', [InternController::class, 'dashboard'])->name('magang.dashboard');
    Route::get('attendance', [InternController::class, 'attendance'])->name('magang.attendance');
    Route::post('check-in', [InternController::class, 'checkIn'])->name('magang.checkIn');
    Route::post('check-out', [InternController::class, 'checkOut'])->name('magang.checkOut');
    Route::get('attendance-history', [InternController::class, 'attendanceHistory'])->name('magang.attendanceHistory');
    Route::get('daily-reports', [InternController::class, 'dailyReports'])->name('magang.dailyReports');
    Route::get('create-daily-report', [InternController::class, 'createDailyReport'])->name('magang.daily-reports.create');
    Route::post('store-daily-report', [InternController::class, 'storeDailyReport'])->name('magang.daily-reports.store');
    Route::get('show-daily-report/{id}', [InternController::class, 'showDailyReport'])->name('magang.daily-reports.show');
    ;
    Route::get('edit-daily-report/{id}', [InternController::class, 'editDailyReport'])->name('magang.daily-reports.edit');
    ;
    Route::post('update-daily-report/{id}', [InternController::class, 'updateDailyReport'])->name('magang.daily-reports.update');
    ;
    Route::get('/magang/tasks/{id}/edit', [InternController::class, 'editTask'])->name('magang.tasks.edit');
    // Route::put('/magang/tasks/{id}', [InternController::class, 'updateTask'])->name('magang.tasks.update');
    Route::put('/magang/tasks/{id}/complete', [InternController::class, 'completeTask'])->name('magang.tasks.complete');


    Route::get('daily-reports-history', [InternController::class, 'dailyReportsHistory'])->name('magang.daily-reports.history');
    Route::get('tasks', [InternController::class, 'tasks'])->name('magang.tasks');
    Route::get('assigned-tasks', [InternController::class, 'assignedTasks']);
    Route::get('completed-tasks', [InternController::class, 'completedTasks']);
    Route::get('approaching-deadline-tasks', [InternController::class, 'approachingDeadlineTasks']);
    Route::get('profile', [InternController::class, 'profile'])->name('magang.profile');
    Route::get('edit-profile', [InternController::class, 'editProfile'])->name('magang.editProfile');
    Route::put('update-profile', [InternController::class, 'updateProfile'])->name('magang.profile.update');

    Route::get('daily_reports', [DailyReportController::class, 'index'])->name('daily_reports.index');
    Route::get('daily_reports/create', [DailyReportController::class, 'create'])->name('daily_reports.create');
    Route::post('daily_reports', [DailyReportController::class, 'store'])->name('daily_reports.store');
    Route::delete('daily_reports/{id}', [DailyReportController::class, 'destroy'])->name('daily_reports.destroy');
    Route::post('/logout/magang', [SessionsController::class, 'destroyMagang'])->name('magang.logout');

});


// Route::middleware(['auth', 'role:supervisor'])->prefix('supervisor')->group(function () {
//     Route::get('dashboard', [SupervisorController::class, 'dashboard']);
//     Route::get('interns', [SupervisorController::class, 'interns']);
//     Route::get('show-intern/{id}', [SupervisorController::class, 'showIntern']);
//     Route::get('intern-attendance/{id}', [SupervisorController::class, 'internAttendance']);
//     Route::get('intern-daily-reports/{id}', [SupervisorController::class, 'internDailyReports']);
//     Route::get('intern-tasks/{id}', [SupervisorController::class, 'internTasks']);
//     Route::get('assigned-tasks', [SupervisorController::class, 'assignedTasks']);
//     Route::get('completed-tasks', [SupervisorController::class, 'completedTasks']);
//     Route::get('approaching-deadline-tasks', [SupervisorController::class, 'approachingDeadlineTasks']);
// });

Route::middleware(['auth', 'role:supervisor'])->group(function () {
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('/supervisor/interns', [SupervisorController::class, 'interns'])->name('supervisor.interns');
    Route::get('/supervisor/interns/{internId}', [SupervisorController::class, 'showIntern'])->name('supervisor.show-intern');
    Route::get('/supervisor/interns/{internId}/attendance', [SupervisorController::class, 'internAttendance'])->name('supervisor.intern-attendance');
    Route::get('/supervisor/interns/{internId}/daily-reports', [SupervisorController::class, 'internDailyReports'])->name('supervisor.intern-daily-reports');
    Route::get('/supervisor/interns/{internId}/tasks', [SupervisorController::class, 'internTasks'])->name('supervisor.intern-tasks');
    Route::get('/supervisor/tasks/assigned', [SupervisorController::class, 'assignedTasks'])->name('supervisor.tasks-assigned');
    Route::get('/supervisor/tasks/completed', [SupervisorController::class, 'completedTasks'])->name('supervisor.tasks-completed');
    Route::get('/supervisor/tasks/approaching-deadline', [SupervisorController::class, 'approachingDeadlineTasks'])->name('supervisor.tasks-approaching-deadline');
    Route::get('/supervisor/tasks/create', [SupervisorController::class, 'createTask'])->name('supervisor.create-task');
    Route::post('/supervisor/tasks', [SupervisorController::class, 'storeTask'])->name('supervisor.store-task');
    Route::get('/supervisor/tasks', [SupervisorController::class, 'tasksBySupervisor'])->name('supervisor.tasks');
    Route::get('/supervisor/tasks/{taskId}/edit', [SupervisorController::class, 'editTask'])->name('supervisor.task-edit');
    Route::put('/supervisor/tasks/{taskId}', [SupervisorController::class, 'updateTask'])->name('supervisor.task-update');
    Route::delete('/supervisor/tasks/{taskId}', [SupervisorController::class, 'deleteTask'])->name('supervisor.task-delete');

    Route::get('daily_reports', [DailyReportController::class, 'indexSup'])->name('daily_reports.indexSup');
    Route::get('/supervisor/daily_reports/{id}/edit', [DailyReportController::class, 'edit'])->name('daily_reports.edit');
    Route::put('/supervisor/daily_reports/{id}', [DailyReportController::class, 'update'])->name('daily_reports.update');
    Route::post('/logout/supervisor', [SessionsController::class, 'destroy'])->name('super.logout');

});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('user-management', [AdminController::class, 'userManagement'])->name('admin.userManagement');
    Route::get('attendance-management', [AdminController::class, 'attendanceManagement']);
    Route::get('report-management', [AdminController::class, 'reportManagement']);

    Route::get('create/{role}', [AdminController::class, 'createUser'])->name('admin.create-user');
    Route::post('store/{role}', [AdminController::class, 'storeUser'])->name('admin.store-user');

    // Route untuk edit user
    Route::get('edit/{role}/{userId}', [AdminController::class, 'editUser'])->name('admin.edit-user');
    Route::post('update/{role}/{userId}', [AdminController::class, 'updateUser'])->name('admin.update-user');

    // Route untuk delete user
    Route::delete('delete/{userId}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
    Route::get('/show/users/{userId}', [AdminController::class, 'show'])->name('admin.show-user');


    Route::get('/create-monthly-report', [AdminController::class, 'createMonthly'])->name('monthly-reports.create');
    Route::post('/store-monthly-report', [AdminController::class, 'storeMonthly'])->name('monthly.store');

    Route::get('/monthly-reports/{id}/edit', [AdminController::class, 'editMonthly'])->name('monthly-reports.edit');
    Route::put('/monthly-reports/{id}', [AdminController::class, 'updateMonthly'])->name('monthly-reports.update');
    Route::delete('/monthly-reports/{id}', [AdminController::class, 'destroyMonthly'])->name('monthly-reports.destroy');



    Route::get('/monthly-reports', [AdminController::class, 'Reports'])->name('monthly-reports.index');

    Route::get('attendance-summary', [AdminController::class, 'attendanceSummary'])->name('admin.attendance-summary');

    // Report Management
    Route::get('daily-reports', [AdminController::class, 'monthlyReports'])->name('admin.monthly-reports');

    // Task Management
    Route::get('manage-tasks', [AdminController::class, 'manageTasks'])->name('admin.manage-tasks');
    Route::get('manage-tasks/{id}/edit', [AdminController::class, 'editTask'])->name('admin.edit-task');
    Route::put('manage-tasks/{id}', [AdminController::class, 'updateTask'])->name('admin.update-task');

    Route::get('task-management', [AdminController::class, 'taskManagement']);
    Route::get('department-management', [AdminController::class, 'departmentManagement'])->name('admin.departmentManagement');

    Route::get('/system-settings', [SystemController::class, 'index'])->name('admin.system-settings');
    Route::get('/system-settings/general', [SystemController::class, 'generalSettings'])->name('admin.system-settings.general');
    Route::get('/system-settings/backup-restore', [SystemController::class, 'backupRestore'])->name('admin.system-settings.backup-restore');
    Route::post('/system-settings/backup', [SystemController::class, 'backup'])->name('admin.system-settings.backup');
    Route::post('/system-settings/restore', [SystemController::class, 'restore'])->name('admin.system-settings.restore');
    Route::post('/system-settings/generale/update/{id}', [SystemController::class, 'update'])->name('admin.system-settings.update');
    Route::resource('departement', DepartmentController::class);
    Route::post('/logout/admin', [SessionsController::class, 'destroyAdmin'])->name('admin.logout');
});
