<?php

namespace App\Http\Controllers;

class EmployeeController extends Controller
{
    public function emp() 
    {
        $employees = [
            ['id' => 'EMP001', 'initials' => 'JD', 'name' => 'Juan Dela Cruz', 'dept' => 'Engineering', 'position' => 'Senior Developer', 'status' => 'Active'],
            ['id' => 'EMP002', 'initials' => 'MS', 'name' => 'Maria Santos', 'dept' => 'Sales', 'position' => 'Sales Manager', 'status' => 'Active'],
            ['id' => 'EMP003', 'initials' => 'JR', 'name' => 'Jose Reyes', 'dept' => 'HR', 'position' => 'HR Officer', 'status' => 'Active'],
            ['id' => 'EMP004', 'initials' => 'RM', 'name' => 'Ana Garcia', 'dept' => 'Marketing', 'position' => 'Marketing Associate', 'status' => 'Active'],
            ['id' => 'EMP005', 'initials' => 'PA', 'name' => 'Pedro Alvarez', 'dept' => 'Engineering', 'position' => 'Junior Developer', 'status' => 'Active'],
            ['id' => 'EMP006', 'initials' => 'AG', 'name' => 'Rosa Mendoza', 'dept' => 'Finance', 'position' => 'Accountant', 'status' => 'Inactive'],
        ];

        return view('employees.index', compact('employees'));
    }
}