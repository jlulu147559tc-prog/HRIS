<?php

namespace App\Http\Controllers;

class PerformanceController extends Controller
{
    public function index()
    {
        // 1. Active Cycle Data
        $cycle = [
            'name' => 'Q1 2026 Performance Review',
            'dates' => 'Jan 1, 2026 - Apr 30, 2026',
            'completed' => 15,
            'total' => 20,
            'progress_percent' => 75 // (15/20) * 100
        ];

        // 2. Evaluation Competencies Data[cite: 1]
        $competencies = [
            ['id' => 1, 'name' => 'Work Quality', 'weight' => '25%'],
            ['id' => 2, 'name' => 'Timeliness', 'weight' => '20%'],
            ['id' => 3, 'name' => 'Teamwork', 'weight' => '20%'],
            ['id' => 4, 'name' => 'Communication', 'weight' => '20%'],
            ['id' => 5, 'name' => 'Initiative', 'weight' => '15%'],
        ];

        // 3. Employee Scores Data[cite: 1]
        $scores = [
            ['initials' => 'JD', 'name' => 'Juan Dela Cruz', 'dept' => 'Engineering', 'c1' => 92, 'c2' => 88, 'c3' => 90, 'c4' => 85, 'c5' => 87, 'composite' => 88.6, 'status' => 'Completed'],
            ['initials' => 'MS', 'name' => 'Maria Santos', 'dept' => 'Sales', 'c1' => 95, 'c2' => 93, 'c3' => 92, 'c4' => 94, 'c5' => 90, 'composite' => 93.1, 'status' => 'Completed'],
            ['initials' => 'JR', 'name' => 'Jose Reyes', 'dept' => 'HR', 'c1' => 88, 'c2' => 90, 'c3' => 89, 'c4' => 91, 'c5' => 86, 'composite' => 89.0, 'status' => 'Completed'],
            ['initials' => 'AG', 'name' => 'Ana Garcia', 'dept' => 'Marketing', 'c1' => 85, 'c2' => 87, 'c3' => 88, 'c4' => 89, 'c5' => 84, 'composite' => 86.7, 'status' => 'Pending'],
            ['initials' => 'PA', 'name' => 'Pedro Alvarez', 'dept' => 'Engineering', 'c1' => 90, 'c2' => 85, 'c3' => 87, 'c4' => 86, 'c5' => 88, 'composite' => 87.5, 'status' => 'Pending'],
        ];

        // 4. Department Distribution Data[cite: 1]
        $distribution = [
            ['dept' => 'Sales', 'score' => 93.1, 'color' => 'bg-[#22C55E]'],
            ['dept' => 'HR', 'score' => 89.0, 'color' => 'bg-[#0B1C3D]'],
            ['dept' => 'Engineering', 'score' => 88.0, 'color' => 'bg-[#F59E0B]'],
            ['dept' => 'Marketing', 'score' => 86.7, 'color' => 'bg-[#3B82F6]'],
            ['dept' => 'Finance', 'score' => 84.5, 'color' => 'bg-[#EF4444]'],
        ];

        return view('performance.index', compact('cycle', 'competencies', 'scores', 'distribution'));
    }
}