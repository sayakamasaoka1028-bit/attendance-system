<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\BreakTime;

class AttendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', Auth::id())
            ->where('work_date', $today)
            ->first();

        return view('attendance.index', compact('attendance'));
    }

    public function clockIn()
    {
        $today = Carbon::today()->toDateString();

        Attendance::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'work_date' => $today,
            ],
            [
                'clock_in' => now(),
            ]
        );

        return redirect()->route('attendance.index');
    }

    public function clockOut()
    {
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', Auth::id())
            ->where('work_date', $today)
            ->first();

        if ($attendance && !$attendance->clock_out) {

            $attendance->clock_out = now();

$totalMinutes =
    Carbon::parse($attendance->clock_in)
        ->diffInMinutes(now());

$attendance->work_minutes =
    $totalMinutes - $attendance->break_minutes;


            $attendance->save();
        }

        return redirect()->route('attendance.index');
    }

public function breakStart()
{
    $today = Carbon::today()->toDateString();

    $attendance = Attendance::where('user_id', Auth::id())
        ->where('work_date', $today)
        ->first();

    if ($attendance) {
        BreakTime::create([
            'attendance_id' => $attendance->id,
            'break_start' => now(),
        ]);
    }

    return redirect()->route('attendance.index');
}

public function breakEnd()
{
    $today = Carbon::today()->toDateString();

    $attendance = Attendance::where('user_id', Auth::id())
        ->where('work_date', $today)
        ->first();

    if ($attendance) {
        $break = BreakTime::where('attendance_id', $attendance->id)
            ->whereNull('break_end')
            ->latest()
            ->first();

        if ($break) {
            $break->break_end = now();
            $break->save();

            $minutes = Carbon::parse($break->break_start)
                ->diffInMinutes($break->break_end);

            $attendance->break_minutes += $minutes;
            $attendance->save();
        }
    }

    return redirect()->route('attendance.index');
}


public function monthly()
{
    $attendances = Attendance::where('user_id', Auth::id())
        ->orderBy('work_date', 'desc')
        ->get();

    $workDays = $attendances->count();

    $totalWorkMinutes = $attendances->sum('work_minutes');

    $totalBreakMinutes = $attendances->sum('break_minutes');

    return view(
        'attendance.monthly',
        compact(
            'attendances',
            'workDays',
            'totalWorkMinutes',
            'totalBreakMinutes'
        )
    );
}



}
