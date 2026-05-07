<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // Find Maria Santos (EMP002)
        $maria = Employee::where('employee_id', 'EMP002')->first();

        if ($maria) {
            $history = [
                ['record_date' => '2026-04-15', 'day_of_week' => 'Tuesday', 'time_in' => '8:00 AM', 'time_out' => '5:00 PM', 'hours_worked' => '8 hrs', 'status' => 'Present'],
                ['record_date' => '2026-04-14', 'day_of_week' => 'Monday', 'time_in' => '8:05 AM', 'time_out' => '5:02 PM', 'hours_worked' => '8 hrs', 'status' => 'Late'],
                ['record_date' => '2026-04-11', 'day_of_week' => 'Friday', 'time_in' => '8:00 AM', 'time_out' => '5:00 PM', 'hours_worked' => '8 hrs', 'status' => 'Present'],
                ['record_date' => '2026-04-10', 'day_of_week' => 'Thursday', 'time_in' => '8:00 AM', 'time_out' => '6:00 PM', 'hours_worked' => '9 hrs', 'status' => 'Overtime'],
                ['record_date' => '2026-04-09', 'day_of_week' => 'Wednesday', 'time_in' => '8:00 AM', 'time_out' => '5:00 PM', 'hours_worked' => '8 hrs', 'status' => 'Present'],
            ];

            foreach ($history as $record) {
                // This uses the relationship to save!
                $maria->attendances()->create($record);
            }
        }
    }
}