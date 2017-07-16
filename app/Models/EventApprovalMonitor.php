<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventApprovalMonitor extends Model
{
  protected $fillable = [
    'event_id',
    'approvers_id'
  ];
}
