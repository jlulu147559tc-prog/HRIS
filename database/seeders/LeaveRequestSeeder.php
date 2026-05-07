<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee; // <-- This is the line that fixes the red error!

class LeaveRequestSeeder extends Seeder
{
    public function run(): void
    {
        // Find Maria Santos (EMP002)
        $maria = Employee::where('employee_id', 'EMP002')->first();

        // Only create records if Maria exists in the database
        if ($maria) {
            $maria->leaveRequests()->createMany([
                [
                    'leave_type' => 'Vacation Leave',
                    'start_date' => '2026-04-20',
                    'end_date' => '2026-04-22',
                    'days_requested' => 3,
                    'reason' => 'Family vacation',
                    'applied_date' => '2026-04-10',
                    'status' => 'Approved',
                    'approved_by' => 'Juan Dela Cruz'
                ],
                [
                    'leave_type' => 'Sick Leave',
                    'start_date' => '2026-03-15',
                    'end_date' => '2026-03-16',
                    'days_requested' => 2,
                    'reason' => 'Flu symptoms',
                    'applied_date' => '2026-03-14',
                    'status' => 'Approved',
                    'approved_by' => 'Juan Dela Cruz'
                ]
            ]);
        }
    }
}