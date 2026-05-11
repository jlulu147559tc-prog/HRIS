<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Attendance;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default date range (Last 6 months)
        $startDate = $request->input('start_date', Carbon::now()->subMonths(5)->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        // 1. Headcount Data (By Department)
        $deptDistribution = Employee::where('status', 'Active')
            ->select('department', DB::raw('count(*) as total'))
            ->groupBy('department')
            ->get();

        // 2. Attendance Data (Present vs Absent for the range)
        $attendanceStats = Attendance::whereBetween('record_date', [$startDate, $endDate])
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // 3. Leave Data (Requests by type)
        $leaveStats = LeaveRequest::whereBetween('start_date', [$startDate, $endDate])
            ->select('leave_type', DB::raw('count(*) as total'))
            ->groupBy('leave_type')
            ->get();

        return view('reports.index', compact('deptDistribution', 'attendanceStats', 'leaveStats', 'startDate', 'endDate'));
    }

    public function exportCsv()
    {
        // Logic for CSV export
        return response()->streamDownload(function () {
            echo "Employee Name, Department, Status\n";
            foreach (Employee::all() as $emp) {
                echo "{$emp->first_name} {$emp->last_name}, {$emp->department}, {$emp->status}\n";
            }
        }, 'HR_Report_' . now()->format('Y-m-d') . '.csv');
    }
}