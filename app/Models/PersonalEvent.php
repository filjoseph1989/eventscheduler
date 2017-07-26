<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalEvent extends Model
{
  protected $dates = ['deleted_at'];

  protected $table = 'personal_events';

  protected $fillable = [
    "user_id",
    "title",
    "description",
    "venue",
    "date_start",
    "date_start_time",
    "date_end",
    "date_end_time",
    "whole_day",
    "event_type_id",
    "category",
    "semester",
    "notify_via_facebook",
    "notify_via_twitter",
    "notify_via_sms",
    "notify_via_email",
    "additional_msg_facebook",
    "additional_msg_sms",
    "additional_msg_email",
    "picture_facebook",
    "picture_twitter",
    "picture_email",
    'status'
  ];

  /**
   * The events own by user
   * @return object
   */
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  /**
   * The events has one category
   *
   * @return object
   */
  public function eventCategory()
  {
    return $this->belongsTo('App\Models\EventCategory');
  }

  /**
   * The event has one type
   *
   * @return object
   */
  public function eventType()
  {
    return $this->belongsTo('App\Models\EventType');
  }

  /**
   * This define the relationship between
   * calendar and events.
   *
   * For every events it correspond to one calendar
   *
   * @return
   */
  public function calendar()
  {
    return $this->belongsTo('App\Models\Calendar');
  }
}
