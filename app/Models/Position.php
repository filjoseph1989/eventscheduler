<?php

namespace App\Models ;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
