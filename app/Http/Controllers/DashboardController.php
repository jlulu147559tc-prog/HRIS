<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Count total Active Employees
        $totalActive = Employee::where('status', 'Active')->count();

        // 2. Get Pending Leave Requests (Fetch the top 3 newest ones)
        $pendingLeaves = LeaveRequest::with('employee')
                            ->where('status', 'Pending')
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();

        // 3. Get New Hires (Employees hired in the last 30 days)
        $newHires = Employee::where('hire_date', '>=', now()->subDays(30))
                            ->orderBy('hire_date', 'desc')
                            ->take(3)
                            ->get();

        // 4. Basic Attendance Stats for Today
        $today = now()->toDateString();
        
        // Count how many people have an attendance record for today
        $presentToday = Attendance::where('record_date', $today)->count();
        
        // Count late arrivals (anyone whose status is 'Late')
        $lateToday = Attendance::where('record_date', $today)
                               ->where('status', 'Late')
                               ->count();
                               
        // Subtract present from total active to get the absent count
        $absentToday = $totalActive - $presentToday;

        // Send all these real numbers to the view!
        return view('dashboard', compact(
            'totalActive', 
            'pendingLeaves', 
            'newHires', 
            'presentToday', 
            'lateToday', 
            'absentToday'
        ));
    }
}