<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
  protected $fillable = [
    'name'
  ];

  /**
   * Defines the relationship between the
   * the calendar and the event
   *
   * form every calendar vent can have many events
   * @return object
   */
  public function events()
  {
    return $this->hasMany('App\Models\Event');
  }
}
