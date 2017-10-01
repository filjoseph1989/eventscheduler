<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationGroup extends Model
{
  protected $fillable = [
    'user_id',
    'organization_id',
    'position_id',
  ];

  /**
   * Organization group contains ID that is belong to
   * an organization make them
   * a one to one relationship
   *
   * @return object
   */
  public function organization()
  {
    return $this->belongsTo('App\Models\Organization');
  }

  /**
   * Organization group contains ID that is belong
   * to a position make it a one to one Relationship with Position
   * one to many relationship between users and positions
   * through organization group
   *
   * wow amaing right? haha
   *
   * @return object
   */
  public function position()
  {
    return $this->belongsTo('App\Models\Position');
  }

  /**
   * Organzation group contains an ID that is
   * belong to a user makes them a ono to one relationship
   * 
   * @return object
   */
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
}
