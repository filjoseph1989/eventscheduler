<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
}
