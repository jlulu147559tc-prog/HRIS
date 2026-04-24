<?php

namespace App\Http\Controllers;

class AttendanceController extends Controller
{
    public function index()
    {
        // Summary Cards Data
        $summary = [
            'regular_hours' => '151.3',
            'overtime' => '1.0',
            'tardiness' => '0.8'
        ];

        // Weekly Matrix Data (Matching the mockup)
        $attendanceMatrix = [
            [
                'name' => 'Juan Dela Cruz',
                'schedule' => [
                    'mon' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'tue' => ['status' => 'Late', 'time' => '08:05 AM - 05:02 PM', 'hours' => '8h'],
                    'wed' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'thu' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'fri' => ['status' => 'Absent', 'time' => '- - -', 'hours' => '-']
                ]
            ],
            [
                'name' => 'Maria Santos',
                'schedule' => [
                    'mon' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'tue' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'wed' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'thu' => ['status' => 'Present', 'time' => '08:00 AM - 06:00 PM', 'hours' => '9h'],
                    'fri' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h']
                ]
            ],
            [
                'name' => 'Jose Reyes',
                'schedule' => [
                    'mon' => ['status' => 'Late', 'time' => '08:15 AM - 05:00 PM', 'hours' => '7.75h'],
                    'tue' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'wed' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'thu' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'fri' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h']
                ]
            ],
            [
                'name' => 'Ana Garcia',
                'schedule' => [
                    'mon' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'tue' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'wed' => ['status' => 'Undertime', 'time' => '08:00 AM - 04:30 PM', 'hours' => '7.5h'],
                    'thu' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h'],
                    'fri' => ['status' => 'Present', 'time' => '08:00 AM - 05:00 PM', 'hours' => '8h']
                ]
            ]
        ];

        return view('attendance.index', compact('summary', 'attendanceMatrix'));
    }
}