<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{ 
    //public $table = "organizations"; 
    /**
     *  The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'acronym',
        // 'description',
        // 'url', 
        // 'status',
        // 'logo',
        // 'color'
    ];

    public function eventGroup()
    {
        return $this->belongsTo('App\Models\EventGroup');
    }
    public function organizationGroup()
    {
        return $this->belongsTo('App\Models\OrganizationGroup');
    }
    public function organizationHeadGroup()
    {
        return $this->belongsTo('App\Models\OrganizationHeadGroup');
    }

}
