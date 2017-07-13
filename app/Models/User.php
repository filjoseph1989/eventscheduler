<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\FacebookPublished;
use Illuminate\Database\Eloquent\SoftDeletes;

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
     * This mean that the user has only one position
     * @return object
     */
    public function course()
    {
      return $this->belongsTo('App\Models\Course');
    }
    public function userAccount(){
      return $this->belongsTo('App\Models\UserAccount');
    }
    public function userHasOneUserAccount(){
      return $this->hasOne('App\Models\UserAccount');
    }
}
