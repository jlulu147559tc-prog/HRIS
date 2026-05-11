<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmployeePortalController extends Controller
{
    // 1. My Dashboard
    public function index()
    {
        $employee = Auth::user();

        // Count their real pending leave requests from the database
        $pendingCount = $employee->leaveRequests()->where('status', 'Pending')->count();

        $data = [
            'employee' => [
                'name' => $employee->first_name, 
                'id' => $employee->employee_id, 
                'dept' => $employee->department, 
                'position' => $employee->position, 
                'hire' => Carbon::parse($employee->hire_date)->format('M d, Y')
            ],
            'stats' => [
                'worked' => $employee->attendances()->count(), 
                'vacation' => $employee->vacation_balance, 
                'sick' => $employee->sick_balance, 
                'pending' => $pendingCount
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
                    'date' => Carbon::parse($attendance->record_date)->format('M d, Y'),
                    'day' => Carbon::parse($attendance->record_date)->format('l'),
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

        $totalVL = 15;
        $totalSL = 15;
        $totalEL = 3;

        $usedVL = max(0, $totalVL - $employee->vacation_balance);
        $usedSL = max(0, $totalSL - $employee->sick_balance);
        $usedEL = max(0, $totalEL - $employee->emergency_balance);

        $nextLeave = $employee->leaveRequests()
            ->where('status', 'Approved')
            ->where('start_date', '>=', now()->toDateString())
            ->orderBy('start_date', 'asc')
            ->first();

        $upcoming = [
            'type' => $nextLeave ? $nextLeave->leave_type : 'No upcoming leaves',
            'dates' => $nextLeave ? Carbon::parse($nextLeave->start_date)->format('M d') . ' to ' . Carbon::parse($nextLeave->end_date)->format('M d, Y') : '---',
            'days' => $nextLeave ? $nextLeave->days_requested : 0,
            'reason' => $nextLeave ? $nextLeave->reason : '---',
            'status' => $nextLeave ? $nextLeave->status : 'N/A'
        ];

        $data = [
            'balances' => [
                ['type' => 'Vacation Leave', 'available' => $employee->vacation_balance, 'used' => $usedVL, 'total' => $totalVL, 'utilized_percent' => round(($usedVL / $totalVL) * 100), 'color' => 'bg-[#10B981]', 'text_color' => 'text-[#10B981]'],
                ['type' => 'Sick Leave', 'available' => $employee->sick_balance, 'used' => $usedSL, 'total' => $totalSL, 'utilized_percent' => round(($usedSL / $totalSL) * 100), 'color' => 'bg-[#F97316]', 'text_color' => 'text-[#F97316]'],
                ['type' => 'Emergency Leave', 'available' => $employee->emergency_balance, 'used' => $usedEL, 'total' => $totalEL, 'utilized_percent' => round(($usedEL / $totalEL) * 100), 'color' => 'bg-[#64748B]', 'text_color' => 'text-[#64748B]'],
            ],
            'upcoming' => $upcoming,
            'history' => $employee->leaveRequests()->orderBy('created_at', 'desc')->get()
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
        }])->find(auth()->id());

        $latestReview = $employee->performanceReviews->first();

        $competencies = [];
        if ($latestReview) {
            $competencies = [
                ['name' => 'Work Quality', 'score' => $latestReview->work_quality, 'weight' => '25%'],
                ['name' => 'Timeliness', 'score' => $latestReview->timeliness, 'weight' => '20%'],
                ['name' => 'Teamwork', 'score' => $latestReview->teamwork, 'weight' => '20%'],
                ['name' => 'Communication', 'score' => $latestReview->communication, 'weight' => '20%'],
                ['name' => 'Initiative', 'score' => $latestReview->initiative, 'weight' => '15%'],
            ];
        }

        $data = [
            'latest' => $latestReview,
            'competencies' => $competencies,
            'history' => $employee->performanceReviews,
            'goals' => [] 
        ];

        return view('employee.performance', compact('data'));
    }

    // 6. My Profile Settings (SYNCED WITH HR RECAP DATA)
    public function profile()
    {
        // Fresh data from DB to ensure sync with HR portal
        $employee = Auth::user()->fresh();

        // 1. Calculate Tenure - Force whole number
        $hireDate = Carbon::parse($employee->hire_date);
        $tenureDays = (int) floor($hireDate->diffInDays(now()));

        // 2. Calculate Age - Updated to use 'date_of_birth' from migration
        $age = "N/A";
        if ($employee->date_of_birth) {
            $age = Carbon::parse($employee->date_of_birth)->age . ' years old';
        }

        $data = [
            'user' => $employee,
            'meta' => [
                'joined' => $hireDate->format('F Y'),
                'tenure' => $tenureDays . ' days',
                'age' => $age,
                'status' => 'Active'
            ]
        ];

        return view('employee.profile', compact('data'));
    }

    // 7. Update Profile Logic
    public function updateProfile(Request $request)
    {
        $employee = Auth::user();

        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $employee->update($request->only(['phone', 'address']));

        return back()->with('success', 'Profile updated successfully.');
    }

    // 8. Leave Store Logic
    public function storeLeave(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        $employee = Auth::user(); 
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $daysRequested = $start->diffInDays($end) + 1;

        $employee->leaveRequests()->create([
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'days_requested' => $daysRequested,
            'reason' => $request->reason,
            'status' => 'Pending', 
            'applied_date' => now(),
        ]);

        return back()->with('success', 'Your leave request has been submitted.');
    }

    // 9. Punch Clock Logic
    public function punchClock(Request $request)
    {
        $employee = Auth::user();
        $todayDate = now()->toDateString(); 
        $currentTime = now()->format('g:i A');

        $attendance = $employee->attendances()->where('record_date', $todayDate)->first();

        if (!$attendance) {
            $isLate = now()->format('H:i') > '08:00';
            $employee->attendances()->create([
                'record_date' => $todayDate,
                'day_of_week' => now()->format('l'),
                'time_in' => $currentTime,
                'status' => $isLate ? 'Late' : 'Present',
            ]);
            return back()->with('success', "Timed In at $currentTime");
        } 
        elseif ($attendance && is_null($attendance->time_out)) {
            $timeIn = Carbon::parse($attendance->time_in);
            $hours = round(now()->diffInMinutes($timeIn) / 60, 2);
            $attendance->update([
                'time_out' => $currentTime,
                'hours_worked' => $hours,
            ]);
            return back()->with('success', "Timed Out. Total hours: $hours");
        } 
        else {
            return back()->with('error', 'Shift completed for today.');
        }
    }
}