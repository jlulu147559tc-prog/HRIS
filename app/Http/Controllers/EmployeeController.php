<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // 1. Fetch employees (with search filtering)
    public function index(Request $request)
    {
        // Capture the search term from the search bar
        $searchTerm = $request->input('search');

        // Start building the database query
        $query = Employee::query();

        // If the user typed something, filter the database results
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                // 1. Check individual columns
                $q->where('first_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('employee_id', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('department', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('position', 'LIKE', "%{$searchTerm}%")
                  
                  // 2. THE MAGIC LINE: Glue first and last name together and check the full string!
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"]);
            });
        }

        // Fetch the filtered (or unfiltered) employees, sorted by first name
        $employees = $query->orderBy('first_name', 'asc')->get();

        // Send them to your HR view!
        return view('employees.index', compact('employees'));
    }

    // 2. Show the Add Employee Form
    public function create()
    {
        return view('employees.create');
    }

    // 3. Store a newly created employee in the database
    public function store(Request $request)
    {
        // 1. Validate the incoming data (Updated to include new personal details)
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'employee_id' => 'required|string|unique:employees,employee_id',
            'department' => 'required|string',
            'position' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|min:6',
            // New validation rules for personal information
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'school' => 'nullable|string|max:255',
            'course' => 'nullable|string|max:255',
        ]);

        // 2. Create the new employee record
        Employee::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            // Automatically grab the first letter of first and last name for the avatar initials
            'initials' => strtoupper(substr($validated['first_name'], 0, 1) . substr($validated['last_name'], 0, 1)),
            'employee_id' => $validated['employee_id'],
            'department' => $validated['department'],
            'position' => $validated['position'],
            'status' => $validated['status'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Hash the password
            'hire_date' => now()->toDateString(),        // Set a default hire date to pass the constraint
            // Save the new personal data
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'school' => $validated['school'] ?? null,
            'course' => $validated['course'] ?? null,
        ]);

        // 3. Redirect back with a success message
        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    // 4. Update an existing employee in the database
    public function update(Request $request, $id)
    {
        // Find the employee by their ID
        $employee = Employee::findOrFail($id);

        // Validate the incoming data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department' => 'required|string',
            'position' => 'required|string',
            'status' => 'required|string',
            // Ignore this employee's current email when checking for unique emails
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'school' => 'nullable|string|max:255',
            'course' => 'nullable|string|max:255',
        ]);

        // Update the employee record
        $employee->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'initials' => strtoupper(substr($validated['first_name'], 0, 1) . substr($validated['last_name'], 0, 1)),
            'department' => $validated['department'],
            'position' => $validated['position'],
            'status' => $validated['status'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'school' => $validated['school'] ?? null,
            'course' => $validated['course'] ?? null,
        ]);

        // Redirect back with a success message
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }
}