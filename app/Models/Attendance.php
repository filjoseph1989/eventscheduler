<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
     protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'did_attend',
        'reason',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }
}
