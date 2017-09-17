<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationGroup extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
      'user_id', 'organization_id', 'membership_status', 'position_id'
    ];

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
     * Relationship with organization
     *
     * @return void
     */
    public function organization()
    {
      return $this->belongsTo('App\Models\Organization');
    }

  public function position()
  {
    return $this->belongsTo('App\Models\Position');
  }

    /**
     * Return the user profile information
     *
     * @return object
     */
    public static function userProfile($auth, $id = false)
    {
      # Use the given ID instead if not false
      if ($id != false) {
        $auth->id = $id;
      }

      $orgGroup = new OrganizationGroup();
      return $orgGroup->select(
          '*',
          'organizations.id as organization_id',
          'organizations.name as organization_name',
          'departments.id as department_id',
          'departments.name as department_name',
          'courses.id as course_id',
          'courses.name as course_name',
          'user_accounts.id as user_account_id',
          'user_accounts.name as user_account_name',
          'positions.id as position_id',
          'positions.name as position_name'
        )
        ->join('users', 'users.id', '=', 'organization_groups.user_id')
        ->join('departments', 'users.department_id', '=', 'departments.id')
        ->join('courses', 'users.course_id', '=', 'courses.id')
        ->join('user_accounts', 'users.user_account_id', '=', 'user_accounts.id')
        ->join('organizations', 'organization_groups.organization_id', '=', 'organizations.id')
        ->join('positions', 'organization_groups.position_id', '=', 'positions.id')
        ->where('user_id', '=', $auth->id)
        ->get();
    }

    /**
     * return member from the given organization ID
     *
     * @param  int $id Organization ID
     * @return object
     */
    public static function getMembers($id)
    {
      $org = new OrganizationGroup();
      return $org->select(
          '*',
          'users.id as user_id'
        )
        ->join('users', 'users.id', '=', 'organization_groups.user_id')
        ->where('organization_groups.organization_id', '=', $id)
        ->get();
    }
}
