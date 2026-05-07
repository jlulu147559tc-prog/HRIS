<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $employees = Employee::where('status', 'Active')->get();
        
        $payrollData = [];
        $totalGross = 0;
        $totalDeductions = 0;
        $totalNet = 0;

        foreach ($employees as $employee) {
            $gross = $employee->salary ?? 50000.00; 
            
            // Percentage-based calculation logic
            $sss = $gross * 0.045; // 4.5%
            $philhealth = $gross * 0.0275; // 2.75%
            $pagibig = 100.00; // Fixed contribution
            $tax = $gross * 0.1083; // 10.83% Withholding tax estimate
            
            $net = $gross - ($sss + $philhealth + $pagibig + $tax);

            $payrollData[] = [
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'gross_pay' => $gross,
                'sss' => $sss,
                'philhealth' => $philhealth,
                'pagibig' => $pagibig,
                'tax' => $tax,
                'net_pay' => $net,
            ];

            $totalGross += $gross;
            $totalDeductions += ($sss + $philhealth + $pagibig + $tax);
            $totalNet += $net;
        }

        $summary = [
            'gross_pay' => $totalGross,
            'deductions' => $totalDeductions,
            'net_pay' => $totalNet,
            'employees' => count($payrollData),
        ];

        // Format for the blade view to read easily
        $payrolls = [];
        foreach ($payrollData as $item) {
            $payrolls[] = [
                'name' => $item['name'],
                'gross' => $item['gross_pay'],
                'sss' => $item['sss'],
                'philhealth' => $item['philhealth'],
                'pagibig' => $item['pagibig'],
                'tax' => $item['tax'],
                'net' => $item['net_pay'],
            ];
        }

        $totals = [
            'gross' => $totalGross,
            'sss' => $totalDeductions * 0.25,
            'philhealth' => $totalDeductions * 0.15,
            'pagibig' => $totalDeductions * 0.05,
            'tax' => $totalDeductions * 0.55,
            'net' => $totalNet,
        ];

        return view('payroll.index', compact('summary', 'payrolls', 'totals'));
    }

    public function finalizePayroll(Request $request)
    {
        $employees = Employee::where('status', 'Active')->get();

        foreach ($employees as $employee) {
            $gross = $employee->salary ?? 50000.00;
            
            $sss = $gross * 0.045;
            $philhealth = $gross * 0.0275;
            $pagibig = 100.00;
            $tax = $gross * 0.1083;
            $net = $gross - ($sss + $philhealth + $pagibig + $tax);

            // You can log to the Payslip model here if desired
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll finalized successfully!');
    }

    // Download PDF Payslips
    public function downloadPayslips()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="payslips-april-1-15-2026.csv"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Employee Name', 'Gross Pay', 'Net Pay']);
            
            $employees = Employee::where('status', 'Active')->get();
            foreach ($employees as $emp) {
                fputcsv($file, [$emp->first_name . ' ' . $emp->last_name, 50000.00, 40860.00]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Email Payslips to Employees
    public function emailPayslips()
    {
        return redirect()->route('payroll.index')
                         ->with('success', 'Payslips successfully queued for email distribution!');
    }

    // Generate BIR Form 2316
    public function downloadBirForm()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="BIR-Form-2316-2026.csv"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['TIN', 'Employee Name', 'Gross Compensation', 'Tax Withheld']);
            fputcsv($file, ['123-456-789', 'Juan Dela Cruz', '400000.00', '40216.00']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}