<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
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
     * This that for every position there's only person
     * associated user
     *
     * @return object
     */
    public function user()
    {
      return $this->hasOne('App\Models\User');
    }

}
