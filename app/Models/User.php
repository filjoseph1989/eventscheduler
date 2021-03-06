<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\FaceBookNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'course_id',
      'user_type_id',
      'full_name',
      'account_number',
      'email',
      'password',
      'facebook',
      'twitter',
      'mobile_number',
      'picture',
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

    /**
     * For eacch user has one user account
     *
     * @return object
     */
    public function userType()
    {
      return $this->belongsTo('App\Models\UserType');
    }

    /**
     * Send Notifications to facebook
     */
    public static function send($message, $picture = '')
    {
      $user = new User();
      return $user->notify(new FaceBookNotification($message, $picture));
    }
}
