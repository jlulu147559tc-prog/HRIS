<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'review_month', 'review_date', 'work_quality', 
        'timeliness', 'teamwork', 'communication', 'initiative', 
        'composite_score', 'comments', 'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}