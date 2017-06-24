<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\FacebookPublished;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_account_id', 'course_id', 'department_id', 'position_id',
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
     *
     * @return [type] [description]
     */

    public static function send()
    {
      $user = new User();
      return $user->notify(new FacebookPublished('test'));
    }
}
