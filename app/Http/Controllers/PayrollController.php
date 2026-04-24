<?php

namespace App\Http\Controllers;

class PayrollController extends Controller
{
    public function index()
    {
        // Summary Cards Data
        $summary = [
            'gross_pay' => '₱210,000.00',
            'deductions' => '₱34,016.67',
            'net_pay' => '₱175,983.33',
            'employees' => 5
        ];

        // Payroll Register Table Data
        $payrolls = [
            ['name' => 'Juan Dela Cruz', 'gross' => '₱50,000.00', 'sss' => '-₱2,250.00', 'philhealth' => '-₱1,375.00', 'pagibig' => '-₱100.00', 'tax' => '-₱5,416.67', 'net' => '₱40,858.33'],
            ['name' => 'Maria Santos', 'gross' => '₱45,000.00', 'sss' => '-₱2,025.00', 'philhealth' => '-₱1,237.50', 'pagibig' => '-₱100.00', 'tax' => '-₱4,208.33', 'net' => '₱37,429.17'],
            ['name' => 'Jose Reyes', 'gross' => '₱42,000.00', 'sss' => '-₱1,890.00', 'philhealth' => '-₱1,155.00', 'pagibig' => '-₱100.00', 'tax' => '-₱3,583.33', 'net' => '₱35,271.67'],
            ['name' => 'Ana Garcia', 'gross' => '₱35,000.00', 'sss' => '-₱1,575.00', 'philhealth' => '-₱962.50', 'pagibig' => '-₱100.00', 'tax' => '-₱2,291.67', 'net' => '₱30,070.83'],
            ['name' => 'Pedro Alvarez', 'gross' => '₱38,000.00', 'sss' => '-₱1,710.00', 'philhealth' => '-₱1,045.00', 'pagibig' => '-₱100.00', 'tax' => '-₱2,791.67', 'net' => '₱32,353.33'],
        ];

        // Totals Row Data
        $totals = [
            'gross' => '₱210,000.00', 'sss' => '-₱9,450.00', 'philhealth' => '-₱5,775.00', 'pagibig' => '-₱500.00', 'tax' => '-₱18,291.67', 'net' => '₱175,983.33'
        ];

        return view('payroll.index', compact('summary', 'payrolls', 'totals'));
    }
}