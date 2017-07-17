<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalEvent extends Model
{
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'event_type_id',
    'event_category_id',
    'calendar_id',
    'user_id',
    'event',
    'description',
    'date_start',
    'date_end',
    'date_start_time',
    'date_end_time',
    'whole_day',
    'venue',
    'status',
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
