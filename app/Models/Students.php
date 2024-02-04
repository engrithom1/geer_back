<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_id','intakes_id','groups_id','created_by'
    ];

    /*public function groups()
    {
        return $this->belongsTo(Groups::class);
        
    }*/
    public function intakes()
    {
        return $this->belongsTo(Intakes::class);
        
    }
}
