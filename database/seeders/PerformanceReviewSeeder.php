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
            // 1. The Latest Review (Mapped to your specific database columns)
            $maria->performanceReviews()->create([
                'review_month' => 'Q1 2026 (Jan - Mar)',
                'review_date' => '2026-04-05',
                'work_quality' => 95,
                'timeliness' => 93,
                'teamwork' => 92,
                'communication' => 94,
                'initiative' => 90,
                'composite_score' => 93.10,
                // Appending the goals and rating into the comments so you don't lose them!
                'comments' => 'Reviewer: Juan Dela Cruz (HR Officer) | Rating: Excellent | Goals Progress: Sales Revenue (85%), Training (100%), Mentoring (60%).',
                'status' => 'Completed'
            ]);

            // 2. Historical Reviews (Filled with estimated competencies to match your scores)
            $maria->performanceReviews()->createMany([
                [
                    'review_month' => 'Q4 2025', 
                    'review_date' => '2026-01-10',
                    'work_quality' => 92, 'timeliness' => 91, 'teamwork' => 92, 'communication' => 92, 'initiative' => 90,
                    'composite_score' => 91.50, 
                    'comments' => 'Reviewer: Juan Dela Cruz | Rating: Excellent',
                    'status' => 'Completed'
                ],
                [
                    'review_month' => 'Q3 2025', 
                    'review_date' => '2025-10-08',
                    'work_quality' => 89, 'timeliness' => 89, 'teamwork' => 90, 'communication' => 89, 'initiative' => 89,
                    'composite_score' => 89.20, 
                    'comments' => 'Reviewer: Juan Dela Cruz | Rating: Good',
                    'status' => 'Completed'
                ],
                [
                    'review_month' => 'Q2 2025', 
                    'review_date' => '2025-07-12',
                    'work_quality' => 89, 'timeliness' => 88, 'teamwork' => 89, 'communication' => 88, 'initiative' => 89,
                    'composite_score' => 88.70, 
                    'comments' => 'Reviewer: Juan Dela Cruz | Rating: Good',
                    'status' => 'Completed'
                ],
            ]);
        }
    }
}