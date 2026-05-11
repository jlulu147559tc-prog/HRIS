<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- Change this line

class Employee extends Authenticatable // <-- Change from "extends Model" to this
{
    use HasFactory;
    
    // These are the fields Laravel is allowed to save via create() or update()
    protected $fillable = [
        'first_name', 'last_name', 'initials', 'employee_id', 
        'department', 'position', 'status', 'email', 'password', 'hire_date',
        // Personal info columns:
        'phone', 'address', 'date_of_birth', 'school', 'course',
        // NEW: Leave Balance columns
        'vacation_balance', 'sick_balance', 'emergency_balance'
    ];

    protected $hidden = [
        'password',
    ];

    // Helper to get full name easily
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Add this right under your getFullNameAttribute function
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaveRequests() 
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

    public function performanceReviews()
    {
        return $this->hasMany(PerformanceReview::class);
    }
}