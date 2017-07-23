<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationAdviserGroup extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'user_id', 'organization_id'
  ];

  /**
   * Defines the relationship between this model and
   * user
   *
   * @return object
   */
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  /**
   * Defines the relationship between this model and
   * organization model
   *
   * @return object
   */
  public function organizations()
  {
    return $this->belongsTo('App\Models\Organization');
  }
}