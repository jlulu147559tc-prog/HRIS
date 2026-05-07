<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'period', 'reviewer_name', 'score', 
        'rating', 'review_date', 'competencies', 'goals'
    ];

    // Tell Laravel these columns contain JSON data
    protected $casts = [
        'competencies' => 'array',
        'goals' => 'array',
        'review_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}