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
}
