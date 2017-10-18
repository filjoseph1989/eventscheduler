<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'organization_id',
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
   * One to one relationship with event_type table
   *
   * @return object
   */
  public function eventType()
  {
    return $this->belongsTo('App\Models\EventType');
  }

  /**
   * One to one relationship with table organization
   *
   * @return object
   */
  public function organization()
  {
    return $this->belongsTo('App\Models\Organization');
  }

  /**
   * One to one relationship with user table
   * @return [type] [description]
   */
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
}
