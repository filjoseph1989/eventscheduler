<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAttendance extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = [
  	'event_id',
  	'user_id',
  	'reason',
  	'status'
  ];

  /**
   * Define the relationship between
   * user and organization group
   *
   * @return object
   */
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  /**
   * Attendance is belong to avent
   * @return
   */
  public function event()
  {
    return $this->belongsTo('App\Models\Event');
  }

}
