<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forums extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description','status','created_by','thumb','views'
    ];

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
