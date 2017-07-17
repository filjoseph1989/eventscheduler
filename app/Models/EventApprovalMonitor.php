<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventApprovalMonitor extends Model
{
  protected $fillable = [
    'event_id',
    'approvers_id'
  ];

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function event(){
    return $this->belongsTo('App\Models\Event');
  }
}
