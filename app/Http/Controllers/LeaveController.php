<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        // 1. Fetch ALL leave requests from the database
        // We use 'with('employee')' to pull the employee's name at the same time!
        $leaveRequests = LeaveRequest::with('employee')->orderBy('created_at', 'desc')->get();

        return view('leave.index', compact('leaveRequests'));
    }

    public function updateStatus(Request $request, $id)
    {
        // 1. Find the specific leave request in the database
        $leave = LeaveRequest::findOrFail($id);

        // 2. Update its status (Approved or Rejected)
        $leave->update([
            'status' => $request->status, 
            'approved_by' => 'HR Admin' // Later, this can be Auth::user()->first_name
        ]);

        // 3. Send the HR Officer back with a success message
        return back()->with('success', 'Leave request marked as ' . $request->status . '!');
    }
}