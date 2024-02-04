<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEmployment extends Model
{
    use HasFactory;

    protected $fillable = [
        'obstacles','carrier_path','engaged','income','job_seeker','activity','enterprise','enterprise_challenge','job_applied','interviews','student_id'
    ];

}
