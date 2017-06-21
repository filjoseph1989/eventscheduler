<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    // public static function registered(){
    //   return static::where('status', 1)->get();
    // }

    public function scopeRegistered($query){
      return $query->where('status', 1);
    }

}
