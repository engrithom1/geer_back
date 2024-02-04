<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CLikes extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id','like_id'
    ];
}
