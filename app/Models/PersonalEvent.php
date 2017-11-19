<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Handle the personal event data
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @company DevCaffee
 * @date
 */
class PersonalEvent extends Model
{
     protected $fillable = [
      'user_id',
      'event_type_id',
      'title',
      'category',
      'description',
      'venue',
      'date_start',
      'date_end',
      'date_start_time',
      'date_end_time',
      'whole_day',
      'status',
      'is_approve',
      'twitter',
      'facebook',
      'facebook_msg',
      'sms',
      'sms_msg',
      'email',
      'email_msg',
      'img',
    ];

    /**
     * One to one relationship with event_type talbe
     * to personal event
     *
     * @return object
     */
    public function eventType()
    {
      return $this->belongsTo('App\Models\EventType');
    }

    /**
     * One to one relationship with orga nization talbe
     * to personal event
     *
     * @return object
     */
    public function organization()
    {
      return $this->belongsTo('App\Models\Organization');
    }

    /**
     * One to one relationship with the use
     *
     * @return object
     */
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    /**
     * Return personal event notification
     */
    public static function getLocalPersonalEventsNotification($id)
    {
      return static::where('event_type_id', 2)
        ->where('user_id', $id)
        ->where('category', 'personal')
        ->where('is_approve', 'false')
        ->get()
        ->toArray();
    }

}
