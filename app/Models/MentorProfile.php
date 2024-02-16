<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'age','sex','experience','education_level','expertise','mentees','skills','time','interest','contact','mentor_id'
    ];
}
