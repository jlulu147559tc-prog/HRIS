<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'attendance' => [
                'present' => 142,
                'absent' => 8,
                'late' => 12,
            ],
            'pending_leaves' => [
                ['name' => 'Maria Santos', 'type' => 'Vacation Leave', 'dates' => 'Apr 20-22, 2026', 'duration' => '3d'],
                ['name' => 'Jose Reyes', 'type' => 'Sick Leave', 'dates' => 'Apr 16-17, 2026', 'duration' => '2d'],
                ['name' => 'Ana Garcia', 'type' => 'Emergency Leave', 'dates' => 'Apr 18, 2026', 'duration' => '1d'],
            ],
            'upcoming_reviews' => [
                ['name' => 'Pedro Alvarez', 'dept' => 'Engineering', 'due' => 'Apr 18, 2026'],
                ['name' => 'Rosa Mendoza', 'dept' => 'Sales', 'due' => 'Apr 20, 2026'],
                ['name' => 'Miguel Torres', 'dept' => 'Marketing', 'due' => 'Apr 22, 2026'],
            ],
            'payroll' => [
                'days_left' => 3,
                'date' => 'April 18, 2026',
                'period' => 'Semi-Monthly Period 1'
            ],
            'new_hires' => [
                ['name' => 'Carlos Luna', 'role' => 'Software Engineer', 'date' => 'Apr 1, 2026', 'initials' => 'CL'],
                ['name' => 'Sofia Ramos', 'role' => 'Sales Associate', 'date' => 'Apr 5, 2026', 'initials' => 'SR'],
                ['name' => 'Diego Cruz', 'role' => 'HR Assistant', 'date' => 'Apr 10, 2026', 'initials' => 'DC'],
            ]
        ];

        return view('dashboard', compact('data'));
    }
}