<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioLists extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_title','audio_url','status','created_by','label','order','audios_id'
    ];

    public function audios()
    {
        return $this->belongsTo(Audios::class);
        
    }
}
