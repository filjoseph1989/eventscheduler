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

    /**
     * one to one relationship with user
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * One to one relationship with events
     *
     * @return object
     */
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    /**
     * Return the organization member attendance
     *
     * @param  int $userId
     * @return object
     */
    public static function getMyAttendance($userId)
    {
      return static::with('event')
        ->where('user_id', $userId)
        ->get();
    }
}
