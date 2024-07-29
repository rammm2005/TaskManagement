<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $interns = Intern::all();
        return view('attendance.index', compact('interns'));
    }

    public function checkIn(Request $request, $internId)
    {
        $intern = Intern::find($internId);
        if (!$intern) {
            return abort(404);
        }

        $attendance = new Attendance;
        $attendance->intern_id = $intern->id;
        $attendance->date = date('Y-m-d');
        $attendance->check_in_time = now();
        $attendance->save();

        return redirect()->route('attendance.index')->with('success', 'Check-in successful for ' . $intern->name . '!');
    }

    public function checkOut(Request $request, $internId)
    {
        $intern = Intern::find($internId);
        if (!$intern) {
            return abort(404);
        }

        $attendance = Attendance::where('intern_id', $intern->id)->where('date', date('Y-m-d'))->first();
        if (!$attendance) {
            return redirect()->route('attendance.index')->with('error', 'You haven\'t checked in yet!');
        }

        $attendance->check_out_time = now();
        $attendance->save();

        return redirect()->route('attendance.index')->with('success', 'Check-out successful for ' . $intern->name . '!');
    }

    public function history($internId)
    {
        $intern = Intern::find($internId);
        if (!$intern) {
            return abort(404);
        }

        $attendances = Attendance::where('intern_id', $intern->id)->get();
        return view('attendance.history', compact('intern', 'attendances'));
    }
}
