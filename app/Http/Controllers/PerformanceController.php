<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        // Get employees for the "Create Review" dropdown
        $employees = Employee::where('status', 'Active')->orderBy('first_name', 'asc')->get();
        
        // Get all reviews to display in the table
        $reviews = PerformanceReview::with('employee')->orderBy('review_date', 'desc')->get();

        return view('performance.index', compact('employees', 'reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'review_month' => 'required|string',
            'work_quality' => 'required|numeric|min:0|max:100',
            'timeliness' => 'required|numeric|min:0|max:100',
            'teamwork' => 'required|numeric|min:0|max:100',
            'communication' => 'required|numeric|min:0|max:100',
            'initiative' => 'required|numeric|min:0|max:100',
        ]);

        // Automatically calculate the composite score (Average of the 5 metrics)
        $composite = (
            $request->work_quality + 
            $request->timeliness + 
            $request->teamwork + 
            $request->communication + 
            $request->initiative
        ) / 5;

        PerformanceReview::create([
            'employee_id' => $request->employee_id,
            'review_month' => $request->review_month,
            'review_date' => now(),
            'work_quality' => $request->work_quality,
            'timeliness' => $request->timeliness,
            'teamwork' => $request->teamwork,
            'communication' => $request->communication,
            'initiative' => $request->initiative,
            'composite_score' => $composite,
            'status' => 'Completed'
        ]);

        return back()->with('success', 'Performance review saved successfully!');
    }
}