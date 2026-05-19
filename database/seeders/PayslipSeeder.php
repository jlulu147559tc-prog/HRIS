<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Payslip;

class PayslipSeeder extends Seeder
{
    public function run(): void
    {
        // Changed this back to employee_id and EMP002 to match your database perfectly
        $maria = Employee::where('employee_id', 'EMP002')->first(); 

        if ($maria) {
            $maria->payslips()->createMany([
                [
                    'period' => 'April 1-15, 2026', 
                    'gross_pay' => 20000.00,
                    'sss_deduction' => 500.00,
                    'philhealth_deduction' => 300.00,
                    'pagibig_deduction' => 100.00,
                    'tax_deduction' => 385.42,
                    'net_pay' => 18714.58, 
                    'status' => 'Finalized'
                ],
                [
                    'period' => 'March 16-31, 2026', 
                    'gross_pay' => 20000.00,
                    'sss_deduction' => 500.00,
                    'philhealth_deduction' => 300.00,
                    'pagibig_deduction' => 100.00,
                    'tax_deduction' => 385.42,
                    'net_pay' => 18714.58, 
                    'status' => 'Finalized'
                ]
            ]);
        }
    }
}