<?php

namespace App\Models ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
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
     * This define a one to one relationship of a
     * position to a user
     *
     * @return object
     */
    public function user()
    {
      return $this->hasOne('App\Models\User');
    }
}
