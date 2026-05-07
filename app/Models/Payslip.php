<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
    'employee_id', 
    'pay_period', // Ensure this is present in the array
    'gross_pay', 
    'sss_deduction', 
    'philhealth_deduction', 
    'pagibig_deduction', 
    'tax_deduction', 
    'net_pay', 
    'status'
];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}