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
        'account_number', //student_number or employee number
        'user_type_id', 
        'email',
        // 'course_id',
          'password',
        //   'facebook',
        //   'twitter',
          'mobile_number',
        //   'picture',
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

     public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

}
