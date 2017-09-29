<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationHeadGroup extends Model
{ 
     /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'organization_id',
    ];

     public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
     public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
