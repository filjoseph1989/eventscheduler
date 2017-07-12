<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Course extends Model
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
