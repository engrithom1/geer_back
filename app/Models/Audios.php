<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audios extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description','status','created_by','group_id'
    ];

    public function audio_lists()
    {
        return $this->hasMany(AudioLists::class);
    }
}
