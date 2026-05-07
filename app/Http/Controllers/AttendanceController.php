<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedWeek = $request->input('week', 'current');
        
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        if ($selectedWeek === 'previous') {
            $startDate = Carbon::now()->subWeek()->startOfWeek();
            $endDate = Carbon::now()->subWeek()->endOfWeek();
        }

        $employees = Employee::where('status', 'Active')->get();
        
        $attendanceMatrix = [];
        $regularHours = 0;
        $overtime = 0;
        $tardiness = 0;

        foreach ($employees as $employee) {
            $schedule = [];
            $periodDays = [
                'mon' => $startDate->copy(),
                'tue' => $startDate->copy()->addDay(1),
                'wed' => $startDate->copy()->addDay(2),
                'thu' => $startDate->copy()->addDay(3),
                'fri' => $startDate->copy()->addDay(4),
            ];

            foreach ($periodDays as $dayKey => $date) {
                // Inside the loop in AttendanceController@index
$record = Attendance::where('employee_id', $employee->id)
    ->where('record_date', $date->toDateString()) // This must match Step 1
    ->first();

                if ($record) {
                    $schedule[$dayKey] = [
                        'status' => $record->status,
                        'time' => $record->time_in . ' - ' . ($record->time_out ?? '---'),
                        'hours' => ($record->hours_worked ?? '0') . 'h',
                    ];
                    // Cast to float before adding
                    $regularHours += (float) $record->hours_worked;
                } else {
                    $schedule[$dayKey] = [
                        'status' => 'Absent',
                        'time' => '---',
                        'hours' => '-'
                    ];
                }
            }

            $attendanceMatrix[] = [
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'schedule' => $schedule,
            ];
        }

        $summary = [
            'regular_hours' => round($regularHours, 1),
            'overtime' => round($overtime, 1),
            'tardiness' => round($tardiness, 1),
        ];

        return view('attendance.index', compact('attendanceMatrix', 'summary', 'selectedWeek'));
    }
}