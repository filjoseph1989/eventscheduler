<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationGroup extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Define the relationship between
     * user and organization group
     *
     * @return object
     */
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    /**
     * Define the relationship between organization group
     * and organization
     *
     * @return object
     */
    public function organization()
    {
      return $this->belongsTo('App\Models\Organization');
    }
}
