<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Models\DailyReport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reports = DailyReport::where('user_id', $user->id)->orderByDesc('date')->get();
        $siteSettings = SiteSetting::firstOrFail();

        return view('daily_reports.index', compact('reports', 'siteSettings'));
    }

    public function indexSup()
    {
        $user = Auth::user();

        $reports = DailyReport::whereHas('user', function ($query) use ($user) {
            $query->where('supervisor_id', $user->id);
        })->orderByDesc('date')->get();

        $siteSettings = SiteSetting::firstOrFail();

        return view('daily_reports.viewing', compact('reports', 'siteSettings'));
    }


    public function create()
    {
        $siteSettings = SiteSetting::firstOrFail();
        return view('daily_reports.create', compact('siteSettings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'tasks_completed' => 'required|string',
            // 'feedback' => 'nullable|string',
        ]);

        $user = Auth::user();

        DailyReport::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'tasks_completed' => $request->tasks_completed,
            // 'feedback' => $request->feedback,
        ]);

        return redirect()->route('daily_reports.index')->with('success', 'Daily report created successfully.');
    }

    public function edit($id)
    {
        $report = DailyReport::findOrFail($id);
        $siteSettings = SiteSetting::firstOrFail();
        return view('daily_reports.edit', compact('report', 'siteSettings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'tasks_completed' => 'required|string',
            'feedback' => 'nullable|string',
        ]);

        $report = DailyReport::findOrFail($id);
        $report->date = $request->date;
        $report->tasks_completed = $request->tasks_completed;
        $report->feedback = $request->feedback;
        $report->save();

        return redirect()->route('daily_reports.indexSup')->with('success', 'Daily report Feedback successfully.');
    }

    public function destroy($id)
    {
        $report = DailyReport::findOrFail($id);
        $report->delete();

        return redirect()->route('daily_reports.index')->with('success', 'Daily report deleted successfully.');
    }
}
