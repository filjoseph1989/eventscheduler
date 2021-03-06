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
      return static::with(['event' => function($query) {
        return $query
          ->with('organization')
          ->get();
      }])->where('user_id', $userId)
        ->get();
    }

    public static function checkUser($userId, $eventId)
    {
      return static::where('user_id', $userId)
        ->where('event_id', $eventId)
        ->first();
    }
}
