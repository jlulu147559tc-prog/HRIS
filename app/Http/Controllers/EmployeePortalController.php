<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeePortalController extends Controller
{
    // 1. My Dashboard
    public function index()
    {
        $employee = Auth::user();

        $data = [
            'employee' => [
                'name' => $employee->first_name, 
                'id' => $employee->employee_id, 
                'dept' => $employee->department, 
                'position' => $employee->position, 
                'hire' => \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y')
            ],
            'stats' => [
                'worked' => 18, 'vacation' => 8, 'sick' => 10, 'pending' => 1
            ],
            'events' => [
                ['title' => 'Performance Review', 'desc' => 'Q1 2026 Performance Evaluation', 'date' => 'Apr 20, 2026', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'color' => 'text-emerald-500', 'bg' => 'bg-emerald-50'],
                ['title' => 'Approved Vacation Leave', 'desc' => '3 days approved', 'date' => 'Apr 20-22, 2026', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'text-emerald-500', 'bg' => 'bg-emerald-50'],
                ['title' => 'Team Building Event', 'desc' => 'Annual company outing', 'date' => 'Apr 25, 2026', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'text-emerald-500', 'bg' => 'bg-emerald-50']
            ],
            'activity' => [
                ['title' => 'Leave request approved', 'desc' => 'Vacation leave for Apr 20-22', 'time' => '2 hours ago'],
                ['title' => 'Payslip available', 'desc' => 'April 1-15, 2026 payroll', 'time' => '1 day ago'],
                ['title' => 'Attendance logged', 'desc' => 'Time in: 8:00 AM', 'time' => 'Today']
            ]
        ];

        return view('employee.dashboard', compact('data'));
    }

    // 2. My Attendance
    public function attendance()
    {
        $employee = Employee::with('attendances')->find(Auth::id());

        $history = collect([]);
        if ($employee && $employee->attendances) {
            $history = $employee->attendances->sortByDesc('record_date')->map(function ($attendance) {
                return [
                    'date' => \Carbon\Carbon::parse($attendance->record_date)->format('M d, Y'),
                    'day' => \Carbon\Carbon::parse($attendance->record_date)->format('l'),
                    'time_in' => $attendance->time_in,
                    'time_out' => $attendance->time_out ?? '---',
                    'hours_worked' => $attendance->hours_worked ? $attendance->hours_worked . ' hrs' : '---',
                    'status' => $attendance->status,
                ];
            });
        }

        $data = [
            'summary' => [
                'worked' => '18/20', 
                'regular' => '144', 
                'overtime' => '4 hrs', 
                'late' => '1', 
                'perfect' => '17', 
                'rate' => '94%'
            ],
            'today' => [
                'status' => 'Logged In', 'time_in' => '8:00 AM', 'duration' => '5h 30m'
            ],
            'history' => $history
        ];

        return view('employee.attendance', compact('data'));
    }

    // 3. My Leave
    public function leave()
    {
        $employee = Auth::user();

        $data = [
            'balances' => [
                ['type' => 'Vacation Leave', 'available' => 8, 'used' => 7, 'total' => 15, 'utilized_percent' => 47, 'color' => 'bg-[#10B981]', 'text_color' => 'text-[#10B981]'],
                ['type' => 'Sick Leave', 'available' => 10, 'used' => 5, 'total' => 15, 'utilized_percent' => 33, 'color' => 'bg-[#10B981]', 'text_color' => 'text-[#10B981]'],
                ['type' => 'Emergency Leave', 'available' => 3, 'used' => 0, 'total' => 3, 'utilized_percent' => 0, 'color' => 'bg-[#10B981]', 'text_color' => 'text-[#10B981]'],
            ],
            'upcoming' => [
                'type' => 'Vacation Leave',
                'dates' => 'Apr 20-22, 2026',
                'days' => 3,
                'reason' => 'Family vacation',
                'status' => 'Approved'
            ],
            'history' => $employee ? $employee->leaveRequests()->orderBy('created_at', 'desc')->get() : collect([])
        ];

        return view('employee.leave', compact('data'));
    }

    // 4. My Payslips
    public function payslips()
    {
        $employee = Employee::with('payslips')->find(Auth::id());

        $data = [
            'ytd' => [
                'gross' => '₱180,000.00',
                'deductions' => '₱30,285.36',
                'net' => '₱149,714.64'
            ],
            'history' => $employee ? $employee->payslips : collect([])
        ];

        return view('employee.payslips', compact('data'));
    }

    // 5. My Performance
    public function performance()
    {
        $employee = Employee::with(['performanceReviews' => function ($query) {
            $query->orderBy('review_date', 'desc');
        }])->find(Auth::id());

        $latestReview = $employee && $employee->performanceReviews ? $employee->performanceReviews->first() : null;

        $data = [
            'latest' => $latestReview,
            'competencies' => $latestReview ? $latestReview->competencies : [],
            'goals' => $latestReview ? $latestReview->goals : [],
            'history' => $employee ? $employee->performanceReviews : [] 
        ];

        return view('employee.performance', compact('data'));
    }

    public function storeLeave(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        $employee = Auth::user();

        $start = \Carbon\Carbon::parse($request->start_date);
        $end = \Carbon\Carbon::parse($request->end_date);
        $days = $start->diffInDays($end) + 1;

        $employee->leaveRequests()->create([
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'days_requested' => $days,
            'reason' => $request->reason,
            'status' => 'Pending',
            'applied_date' => now(),
        ]);

        return back()->with('success', 'Leave request submitted successfully!');
    }

    public function punchClock(Request $request)
{
    $employee = Auth::user();
    
    // Use the standard database format for searching
    $todayDate = now()->toDateString(); // Formats as YYYY-MM-DD
    $currentTime = now()->format('g:i A');

    // Find the record for today that belongs to this employee
    $attendance = $employee->attendances()->where('record_date', $todayDate)->first();

    // CASE 1: No record exists yet -> TIME IN
    if (!$attendance) {
        $isLate = now()->format('H:i') > '08:00';
        
        $employee->attendances()->create([
            'record_date' => $todayDate,
            'day_of_week' => now()->format('l'),
            'time_in' => $currentTime,
            'time_out' => null,
            'hours_worked' => null,
            'rendered_hours' => null,
            'status' => $isLate ? 'Late' : 'Present',
            'remarks' => $isLate ? 'Late entry' : 'On time',
        ]);
        
        return back()->with('success', "You have successfully Timed In at $currentTime");
    } 
    
    // CASE 2: Record exists but Time Out is empty -> TIME OUT
    elseif ($attendance && is_null($attendance->time_out)) {
        $timeIn = \Carbon\Carbon::parse($attendance->time_in);
        $timeOut = now();
        
        // Calculate decimal hours (e.g., 8.5)
        $hours = round($timeOut->diffInMinutes($timeIn) / 60, 2);

        $attendance->update([
            'time_out' => $currentTime,
            'hours_worked' => $hours,
            'rendered_hours' => $hours,
        ]);
        
        return back()->with('success', "You have successfully Timed Out at $currentTime. Total hours: $hours");
    } 
    
    // CASE 3: Already Timed Out for today
    else {
        return back()->with('error', 'You have already completed your shift for today.');
    }
}
}