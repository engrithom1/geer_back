<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intakes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','status','created_by'
    ];

    public function students()
    {
        return $this->hasMany(Students::class);
    }
}
