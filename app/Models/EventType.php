<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
  use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
      'name',
    ];

    /**
     * The organization can have many events
     *
     * @return object
     */
    public function events()
    {
      return $this->hasMany('App\Models\Organization');
    }
}
