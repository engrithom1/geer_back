<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'comment','likes','comment_by','forums_id'
    ];

    public function forums()
    {
        return $this->belongsTo(Forums::class);
        
    }
}
