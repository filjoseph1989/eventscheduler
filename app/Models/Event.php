<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author jlvoice777
 * @since 0.1
 * @version 0.2
 * @updated 7/15/2017
 */
class Event extends Model
{
  use SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'event_type_id',
    'event_category_id',
    'organization_id',
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
    'approver_count'
  ];

  /**
   * The events own by organization
   *
   * @return object
   */
  public function organization()
  {
    return $this->belongsTo('App\Models\Organization');
  }

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

  public function organizationGroup()
  {
    return $this->hasMany('App\Models\OrganizationGroup');
  }

}
