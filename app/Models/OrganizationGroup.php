<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationGroup extends Model
{
    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'organization_id',
        'position_id',
    ];

     public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
     public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

     public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
