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
      'semester_id',
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
      'twitter_msg',
      'twitter_img',
      'facebook',
      'facebook_msg',
      'facebook_img',
      'sms',
      'sms_msg',
      'email',
      'email_msg',
      'email_img',
    ];

    /**
     * One to one relationship of personal events
     * to event group
     *
     * Issue 30
     * No event group needed I think
     *
     * @return object
     */
    public function eventGroup()
    {
      return $this->belongsTo('App\Models\EventGroup');
    }

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
     * One to one relationship with the use
     *
     * @return object
     */
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }
}
