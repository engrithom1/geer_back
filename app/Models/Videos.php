<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description','status','created_by','thumb','group_id',
    ];

    public function video_lists()
    {
        return $this->hasMany(VideoLists::class);
    }
}
