<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'full_name',
      'account_number',
      'user_type_id',
      'email',
      'course_id',
      'password',
      'mobile_number',
      'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];

    /**
     * Relationship between course
     *
     * @return object
     */
    public function course()
    {
      return $this->belongsTo('App\Models\Course');
    }

    /**
     * Foreach user has can be a member of many organization
     * and can have many positions
     */
    public function OrganizationGroup()
    {
      return $this->hasMany('App\Models\OrganizationGroup');
    }
}
