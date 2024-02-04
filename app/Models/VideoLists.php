<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLists extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_title','video_url','status','created_by','label','order','videos_id'
    ];

    public function videos()
    {
        return $this->belongsTo(Videos::class);
        
    }
}
