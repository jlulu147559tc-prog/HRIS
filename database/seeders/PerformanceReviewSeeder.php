<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\PerformanceReview;

class PerformanceReviewSeeder extends Seeder
{
    public function run(): void
    {
        $maria = Employee::where('employee_id', 'EMP002')->first();

        if ($maria) {
            // The Latest Review (Includes competencies and goals)
            $maria->performanceReviews()->create([
                'period' => 'Q1 2026 (Jan - Mar)',
                'reviewer_name' => 'Juan Dela Cruz (HR Officer)',
                'score' => 93.1,
                'rating' => 'Excellent',
                'review_date' => '2026-04-05',
                'competencies' => [
                    ['name' => 'Work Quality', 'weight' => '25%', 'score' => 95],
                    ['name' => 'Timeliness', 'weight' => '20%', 'score' => 93],
                    ['name' => 'Teamwork', 'weight' => '20%', 'score' => 92],
                    ['name' => 'Communication', 'weight' => '20%', 'score' => 94],
                    ['name' => 'Initiative', 'weight' => '15%', 'score' => 90],
                ],
                'goals' => [
                    ['title' => 'Increase sales revenue by 15%', 'deadline' => 'Jun 30, 2026', 'progress' => 85, 'status' => 'On Track', 'color' => 'bg-[#DCFCE7] text-[#16A34A]'],
                    ['title' => 'Complete advanced sales training', 'deadline' => 'Mar 31, 2026', 'progress' => 100, 'status' => 'Completed', 'color' => 'bg-[#DCFCE7] text-[#16A34A]'],
                    ['title' => 'Mentor 2 junior sales associates', 'deadline' => 'Dec 31, 2026', 'progress' => 60, 'status' => 'In Progress', 'color' => 'bg-[#FFEDD5] text-[#EA580C]'],
                ]
            ]);

            // Historical Reviews (Older ones don't need the full details for the prototype)
            $maria->performanceReviews()->createMany([
                ['period' => 'Q4 2025', 'reviewer_name' => 'Juan Dela Cruz', 'score' => 91.5, 'rating' => 'Excellent', 'review_date' => '2026-01-10'],
                ['period' => 'Q3 2025', 'reviewer_name' => 'Juan Dela Cruz', 'score' => 89.2, 'rating' => 'Good', 'review_date' => '2025-10-08'],
                ['period' => 'Q2 2025', 'reviewer_name' => 'Juan Dela Cruz', 'score' => 88.7, 'rating' => 'Good', 'review_date' => '2025-07-12'],
            ]);
        }
    }
}