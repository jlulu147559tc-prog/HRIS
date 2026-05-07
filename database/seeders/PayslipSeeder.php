<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Payslip;

class PayslipSeeder extends Seeder
{
    public function run(): void
    {
        $maria = Employee::where('employee_id', 'EMP002')->first();

        if ($maria) {
            $maria->payslips()->createMany([
                ['period' => 'April 1-15, 2026', 'pay_date' => '2026-04-18', 'amount' => '₱18,714.58', 'status' => 'Paid'],
                ['period' => 'March 16-31, 2026', 'pay_date' => '2026-04-03', 'amount' => '₱18,714.58', 'status' => 'Paid'],
                ['period' => 'March 1-15, 2026', 'pay_date' => '2026-03-18', 'amount' => '₱18,714.58', 'status' => 'Paid'],
                ['period' => 'February 16-29, 2026', 'pay_date' => '2026-03-03', 'amount' => '₱18,714.58', 'status' => 'Paid'],
            ]);
        }
    }
}