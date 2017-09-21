<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Notifications\FacebookPublished;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
      'user_account_id', 'course_id', 'department_id',
      'account_number', 'email', 'password', 'first_name', 'last_name',
      'middle_name', 'suffix_name', 'facebook_username', 'twitter_username',
      'instagram_username', 'mobile_number', 'status',
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
     * Send notification on fb page
     * ! Deprecated
     *
     * @return [type] [description]
     */
    public static function send($message = "")
    {
      $user = new User();
      return $user->notify(new FacebookPublished($message));
    }

    /**
     * This mean that the user belong to a one department
     * @return object
     */
    public function department()
    {
      return $this->belongsTo('App\Models\Department');
    }

    /**
     * Define the relationship between user and course
     *
     * @return object
     */
    public function course()
    {
      return $this->belongsTo('App\Models\Course');
    }

    /**
     * The user can have many events set
     *
     * @return object
     */
    public function events()
    {
      return $this->hasMany('App\Models\Event');
    }

    /**
     * Define the relationship between
     * user and organization group
     *
     * @return object
     */
    public function organizationGroup()
    {
      return $this->hasMany('App\Models\OrganizationGroup');
    }

    /**
     * Defines the relationship between user account and
     * this account
     *
     * @return object
     */
    public function userAccount()
    {
      return $this->belongsTo('App\Models\UserAccount');
    }

    /**
     * Defines the relationship between user account and
     * this account
     *
     * @return object
     */
    public function userHasOneUserAccount()
    {
      return $this->hasOne('App\Models\UserAccount');
    }

    /**
     * Defines the relationship between user approval monitor and
     * this account
     *
     * @return object
     */
    public function event_approval_monitors()
    {
      return $this->hasMany('App\Models\EventApprovalMonitor');
    }

    /**
     * Defines the relationship between user approval monitor and
     * this account
     *
     * @return object
     */
    public function organizationAdviserGroup()
    {
      return $this->hasMany('App\Models\OrganizationAdviserGroup');
    }
}
