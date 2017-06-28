<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'status', 'url', 'date_started', 'date_expired',
    ];

    // public static function registered(){
    //   return static::where('status', 1)->get();
    // }

    public function scopeRegistered($query){
      return $query->where('status', 1);
    }

}
