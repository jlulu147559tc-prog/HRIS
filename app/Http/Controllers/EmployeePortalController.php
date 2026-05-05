<?php

namespace App\Http\Controllers;

class EmployeePortalController extends Controller
{
    // 1. My Dashboard
    public function index()
    {
        $data = [
            'employee' => [
                'name' => 'Maria', 'id' => 'EMP002', 'dept' => 'Sales', 'position' => 'Sales Manager', 'hire' => 'Mar 10, 2019'
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
        $data = [
            'summary' => [
                'worked' => '18/20', 'regular' => '144', 'overtime' => '4 hrs', 
                'late' => '1', 'perfect' => '17', 'rate' => '94%'
            ],
            'today' => [
                'status' => 'Logged In', 'time_in' => '8:00 AM', 'duration' => '5h 30m'
            ],
            'history' => [
                ['date' => 'Apr 15, 2026', 'day' => 'Tuesday', 'in' => '8:00 AM', 'out' => '5:00 PM', 'hours' => '8 hrs', 'status' => 'Present', 'color' => 'text-[#10B981] border-[#10B981]/20 bg-[#F0FDF4]'],
                ['date' => 'Apr 14, 2026', 'day' => 'Monday', 'in' => '8:05 AM', 'out' => '5:02 PM', 'hours' => '8 hrs', 'status' => 'Late', 'color' => 'text-[#F59E0B] border-[#F59E0B]/20 bg-[#FFFBEB]'],
                ['date' => 'Apr 11, 2026', 'day' => 'Friday', 'in' => '8:00 AM', 'out' => '5:00 PM', 'hours' => '8 hrs', 'status' => 'Present', 'color' => 'text-[#10B981] border-[#10B981]/20 bg-[#F0FDF4]'],
                ['date' => 'Apr 10, 2026', 'day' => 'Thursday', 'in' => '8:00 AM', 'out' => '6:00 PM', 'hours' => '9 hrs', 'status' => 'Overtime', 'color' => 'text-[#10B981] border-[#10B981]/20 bg-[#F0FDF4]'],
                ['date' => 'Apr 9, 2026', 'day' => 'Wednesday', 'in' => '8:00 AM', 'out' => '5:00 PM', 'hours' => '8 hrs', 'status' => 'Present', 'color' => 'text-[#10B981] border-[#10B981]/20 bg-[#F0FDF4]'],
                ['date' => 'Apr 8, 2026', 'day' => 'Tuesday', 'in' => '8:00 AM', 'out' => '5:00 PM', 'hours' => '8 hrs', 'status' => 'Present', 'color' => 'text-[#10B981] border-[#10B981]/20 bg-[#F0FDF4]'],
                ['date' => 'Apr 7, 2026', 'day' => 'Monday', 'in' => '8:00 AM', 'out' => '5:00 PM', 'hours' => '8 hrs', 'status' => 'Present', 'color' => 'text-[#10B981] border-[#10B981]/20 bg-[#F0FDF4]'],
            ]
        ];

        return view('employee.attendance', compact('data'));
    }

    // 3. My Leave
    public function leave()
    {
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
            'history' => [
                ['type' => 'Vacation Leave', 'date_start' => 'Apr 20, 2026', 'date_end' => 'to Apr 22, 2026', 'days' => 3, 'reason' => 'Family vacation', 'applied' => 'Apr 10, 2026', 'status' => 'Approved', 'approver' => 'Juan Dela Cruz'],
                ['type' => 'Sick Leave', 'date_start' => 'Mar 15, 2026', 'date_end' => 'to Mar 16, 2026', 'days' => 2, 'reason' => 'Flu symptoms', 'applied' => 'Mar 14, 2026', 'status' => 'Approved', 'approver' => 'Juan Dela Cruz'],
                ['type' => 'Vacation Leave', 'date_start' => 'Feb 10, 2026', 'date_end' => 'to Feb 14, 2026', 'days' => 5, 'reason' => 'Personal matters', 'applied' => 'Feb 1, 2026', 'status' => 'Approved', 'approver' => 'Juan Dela Cruz'],
            ]
        ];

        return view('employee.leave', compact('data'));
    }

    // 4. My Payslips
    public function payslips()
    {
        $data = [
            'ytd' => [
                'gross' => '₱180,000.00',
                'deductions' => '₱30,285.36',
                'net' => '₱149,714.64'
            ],
            'history' => [
                ['period' => 'April 1-15, 2026', 'date' => 'Apr 18, 2026', 'amount' => '₱18,714.58', 'status' => 'Paid'],
                ['period' => 'March 16-31, 2026', 'date' => 'Apr 3, 2026', 'amount' => '₱18,714.58', 'status' => 'Paid'],
                ['period' => 'March 1-15, 2026', 'date' => 'Mar 18, 2026', 'amount' => '₱18,714.58', 'status' => 'Paid'],
                ['period' => 'February 16-29, 2026', 'date' => 'Mar 3, 2026', 'amount' => '₱18,714.58', 'status' => 'Paid'],
            ]
        ];

        return view('employee.payslips', compact('data'));
    }

    // 5. My Performance
    public function performance()
    {
        $data = [
            'latest' => [
                'period' => 'Q1 2026 (Jan - Mar)', 'reviewer' => 'Juan Dela Cruz (HR Officer)',
                'score' => '93.1', 'rating' => 'Excellent', 'date' => 'Apr 5, 2026'
            ],
            'competencies' => [
                ['name' => 'Work Quality', 'weight' => '25%', 'score' => 95],
                ['name' => 'Timeliness', 'weight' => '20%', 'score' => 93],
                ['name' => 'Teamwork', 'weight' => '20%', 'score' => 92],
                ['name' => 'Communication', 'weight' => '20%', 'score' => 94],
                ['name' => 'Initiative', 'weight' => '15%', 'score' => 90],
            ],
            'goals' => [
                ['title' => 'Increase sales revenue by 15%', 'deadline' => 'Jun 30, 2026', 'progress' => 85, 'status' => 'On Track', 'color' => 'bg-[#DCFCE7] text-[#16A34A]'],
                ['title' => 'Complete advanced sales training', 'deadline' => 'Mar 31, 2026', 'progress' => 100, 'status' => 'Completed', 'color' => 'bg-[#DCFCE7] text-[#16A34A]'],
                ['title' => 'Mentor 2 junior sales associates', 'deadline' => 'Dec 31, 2026', 'progress' => 60, 'status' => 'In Progress', 'color' => 'bg-[#FFEDD5] text-[#EA580C]'],
            ],
            'history' => [
                ['period' => 'Q1 2026', 'date' => 'Apr 5, 2026', 'score' => '93.1', 'rating' => 'Excellent', 'color' => 'text-[#16A34A]'],
                ['period' => 'Q4 2025', 'date' => 'Jan 10, 2026', 'score' => '91.5', 'rating' => 'Excellent', 'color' => 'text-[#16A34A]'],
                ['period' => 'Q3 2025', 'date' => 'Oct 8, 2025', 'score' => '89.2', 'rating' => 'Good', 'color' => 'text-[#10B981]'],
                ['period' => 'Q2 2025', 'date' => 'Jul 12, 2025', 'score' => '88.7', 'rating' => 'Good', 'color' => 'text-[#10B981]'],
            ]
        ];

        return view('employee.performance', compact('data'));
    }
}