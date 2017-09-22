<?php

namespace App\Http\Controllers\OrganizationHead;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

# Models
use App\Models\User;
use App\Models\Position;
use App\Models\OrganizationGroup;
use App\Models\OrganizationHeadGroup;
use App\Models\Organization;

use Auth;

/**
 * Class for user
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @since 0.1
 * @version 0.1
 * @created 8-26-2017
 * @updated 8-26-2017
 */
class UserController extends Controller
{
  private $path = "pages/users/organization-head/";

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('web');
  }

  /**
   * This method search teh user table to be used
   * by organization head to add new organization memeber
   *
   * ! Deprecated
   *
   * @param  Request $data
   * @return Illuminate\Response
   */
  public function search(Request $data)
  {
    $user = User::with(['course', 'department'])
      ->where('account_number', 'LIKE', '%' . $data->search . '%')
      ->get();

    $position = Position::all();

    if ($user->count() != 0) {
      $login_type = 'user';
      return view($this->path . 'members/list', compact(
        'user', 'login_type', 'position'
      ));
    }

    return back()
      ->with('status_warning', 'Sorry We couldn\'t find what your looking for.');
  }

  /**
   * Display the list of members not yet belong
   * to the organization of the organization head account
   *
   * @return Illuminate\Response
   */
  public function show()
  {
    parent::loginCheck();

    extract( self::getOrganization() );

    $members     = self::getMembers($orgId);
    $users       = self::getUser();

    # alter the list of users
    self::userToInvite($users, $members);

    return view($this->path . 'members/list', compact('users', 'orgId', 'orgName'))
      ->with(['login_type' => 'user']);
  }

  /**
   * return the organization ID of the
   * organization head
   *
   * @return int Organization ID
   */
  private function getOrganization()
  {
    $membership = OrganizationGroup::with('organization')
      ->where('user_id', '=', Auth::user()->id)
      ->get();

    return [
      'orgId'   => $membership[0]->organization_id,
      'orgName' => $membership[0]->organization->name,
    ];
  }

  /**
   * Return the list of users not belong to a given
   * organization
   *
   * @param int $id Organization ID
   * @return void
   */
  private function getMembers($id)
  {
    return OrganizationGroup::where('organization_id', '=', $id)
      ->get()
      ->toArray();
  }

   /**
   * Get all registered active users
   *
   * @return object
   */
  private function getUser()
  {
    return User::with(['department', 'course'])
      ->where('status', '=', 1)
      ->where('user_account_id', '!=', 1) # Wala apil ang admin account sa i invite
      ->get();
  }

   /**
    * Modify the list of users to invite list
    *
    * @return void
    */
  private function userToInvite(&$users, &$members)
  {
    foreach ($users as $key => $value) {
      if (array_search($value->id, array_column($members, 'id')) !== false) {
        unset($users[$key]);
      }
    }
  }
}
