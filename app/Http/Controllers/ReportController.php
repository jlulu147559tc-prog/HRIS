<?php

namespace App\Http\Controllers;

class ReportController extends Controller
{
    public function index()
    {
        // Filter Default Data
        $filters = [
            'start_date' => '10/01/2025',
            'end_date' => '03/31/2026'
        ];

        // Line Chart Data (Headcount Trend)
        $trend = [
            ['month' => 'Oct 25', 'value' => 160, 'y_pos' => '11%'],
            ['month' => 'Nov 25', 'value' => 162, 'y_pos' => '10%'],
            ['month' => 'Dec 25', 'value' => 162, 'y_pos' => '10%'],
            ['month' => 'Jan 26', 'value' => 165, 'y_pos' => '8%'],
            ['month' => 'Feb 26', 'value' => 168, 'y_pos' => '6%'],
            ['month' => 'Mar 26', 'value' => 170, 'y_pos' => '5%'],
        ];

        // Pie Chart Data (Department Distribution)
        $distribution = [
            ['dept' => 'Engineering', 'percent' => 26, 'color' => '#1E293B'], // Slate 800
            ['dept' => 'Operations', 'percent' => 13, 'color' => '#A855F7'],  // Purple 500
            ['dept' => 'Finance', 'percent' => 13, 'color' => '#EF4444'],     // Red 500
            ['dept' => 'HR', 'percent' => 9, 'color' => '#3B82F6'],           // Blue 500
            ['dept' => 'Marketing', 'percent' => 16, 'color' => '#F59E0B'],   // Amber 500
            ['dept' => 'Sales', 'percent' => 22, 'color' => '#22C55E'],       // Green 500
        ];

        return view('reports.index', compact('filters', 'trend', 'distribution'));
    }
}