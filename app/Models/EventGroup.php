<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventGroup extends Model
{
    public $table = "events_groups"; 

    public function organization()
    {
      return $this->belongsTo('App\Models\Organization');
    }
}
