<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{ 
    //public $table = "organizations"; 
    /**
     *  The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_type_id',
        'name',
        'description',
        'url',
        'status',
        'logo',
        'color'
    ];

    public function eventGroup()
  {
    return $this->belongsTo('App\Models\EventGroup');
  }
    
  
}
