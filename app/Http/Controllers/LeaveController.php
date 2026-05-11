<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function index()
    {
        // Fetch all active employees to populate the dropdown and the balance table
        $employees = Employee::where('status', 'Active')->orderBy('first_name', 'asc')->get();
        
        // Fetch leave requests
        $leaveRequests = LeaveRequest::with('employee')->orderBy('created_at', 'desc')->get();

        return view('leave.index', compact('employees', 'leaveRequests'));
    }

    // Handle the HR Leave Submission (Auto-Approved)
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        // THE 3-DAY ADVANCE RULE
        // We only enforce this for Vacation Leave. Sick/Emergency can be filed same-day.
        if ($request->leave_type === 'Vacation Leave') {
            $threeDaysFromNow = Carbon::today()->addDays(3);
            $requestedStartDate = Carbon::parse($request->start_date);

            if ($requestedStartDate->lessThan($threeDaysFromNow)) {
                return back()->with('error', 'Vacation Leave must be applied for at least 3 days in advance. The earliest date you can select is ' . $threeDaysFromNow->format('F d, Y') . '.');
            }
        }

        $employee = Employee::findOrFail($request->employee_id);
        
        // Calculate how many days they are requesting
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $daysRequested = $start->diffInDays($end) + 1;

        // Determine which balance to check
        $balanceColumn = '';
        if ($request->leave_type == 'Vacation Leave') $balanceColumn = 'vacation_balance';
        elseif ($request->leave_type == 'Sick Leave') $balanceColumn = 'sick_balance';
        elseif ($request->leave_type == 'Emergency Leave') $balanceColumn = 'emergency_balance';

        // Check if they have enough balance
        if ($balanceColumn && $employee->$balanceColumn < $daysRequested) {
            return back()->with('error', "Cannot apply: {$employee->first_name} only has {$employee->$balanceColumn} days of {$request->leave_type} left.");
        }

        // Deduct balance automatically
        if ($balanceColumn) {
            $employee->decrement($balanceColumn, $daysRequested);
        }

        // Create the leave record
        $employee->leaveRequests()->create([
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'days_requested' => $daysRequested,
            'reason' => $request->reason,
            'status' => 'Approved', 
            'applied_date' => now(),
        ]);

        return back()->with('success', "Leave successfully applied and {$daysRequested} days deducted from balance.");
    }

    // RESTORED & UPGRADED: Approve or Reject an Employee's Leave Request
    public function updateStatus(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $newStatus = $request->input('status'); // 'Approved' or 'Rejected'

        // If HR is Approving it, we must deduct the days from their balance!
        if ($newStatus === 'Approved' && $leaveRequest->status !== 'Approved') {
            $employee = $leaveRequest->employee;
            $balanceColumn = '';

            if ($leaveRequest->leave_type == 'Vacation Leave') $balanceColumn = 'vacation_balance';
            elseif ($leaveRequest->leave_type == 'Sick Leave') $balanceColumn = 'sick_balance';
            elseif ($leaveRequest->leave_type == 'Emergency Leave') $balanceColumn = 'emergency_balance';

            // Check if they have enough balance before approving
            if ($balanceColumn && $employee->$balanceColumn < $leaveRequest->days_requested) {
                return back()->with('error', "Cannot approve: {$employee->first_name} only has {$employee->$balanceColumn} days left.");
            }

            // Deduct the balance
            if ($balanceColumn) {
                $employee->decrement($balanceColumn, $leaveRequest->days_requested);
            }
        }

        // Update the actual request status
        $leaveRequest->update([
            'status' => $newStatus
        ]);

        return back()->with('success', "Leave request marked as {$newStatus} successfully!");
    }
}