<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    // These are the fields Laravel is allowed to save via create() or update()
    protected $fillable = [
        'employee_id',
        'record_date',
        'day_of_week',
        'time_in',
        'time_out',
        'hours_worked',
        'rendered_hours',
        'status',
        'remarks'
    ];

    // Optional: If you want to associate attendance back to the employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}