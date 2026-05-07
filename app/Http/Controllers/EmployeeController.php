<?php

namespace App\Http\Controllers;

use App\Models\Employee; // Important: Make sure this is imported!
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function emp()
    {
        // 1. Fetch ALL employees from the database, sorted by their first name
        $employees = Employee::orderBy('first_name', 'asc')->get();

        // 2. Send them to your HR view!
        return view('employees.index', compact('employees'));
    }

    // 3. Show the Add Employee Form
    public function create()
    {
        return view('employees.create');
    }

    // 4. Store a newly created employee in the database
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'employee_id' => 'required|string|unique:employees,employee_id',
            'department' => 'required|string',
            'position' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|min:6',
        ]);

        // 2. Split the single 'name' input into 'first_name' and 'last_name'
        $fullName = explode(' ', $validated['name']);
        $firstName = $fullName[0];
        $lastName = isset($fullName[1]) ? implode(' ', array_slice($fullName, 1)) : $firstName;

        // 3. Create the new employee record
        Employee::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'initials' => substr($firstName, 0, 1) . (isset($lastName) ? substr($lastName, 0, 1) : ''),
            'employee_id' => $validated['employee_id'],
            'department' => $validated['department'],
            'position' => $validated['position'],
            'status' => $validated['status'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Hash the password
            'hire_date' => now()->toDateString(),        // Set a default hire date to pass the constraint
        ]);

        // 4. Redirect back with a success message
        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }
}