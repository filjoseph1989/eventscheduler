<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
      //public $table = "user_types";
    /**
     *  The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'acronym',
        'theme',
        'color',
        // 'status',
        // 'logo',
        // 'color'
    ];
    
}
