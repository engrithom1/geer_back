<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentNeeds extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity','capacity_institution','capacity_type','training','why_training','skill_need','critical_skills','training_time','disability','student_id'
    ];
}
