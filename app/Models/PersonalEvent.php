<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

  
  public function eventGroup()
  {
    return $this->belongsTo('App\Models\EventGroup');
  }

  public function eventType()
  {
    return $this->belongsTo('App\Models\EventType');
  }


  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
}
