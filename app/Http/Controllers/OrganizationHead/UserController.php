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

    $orgId   = self::getOrganization();
    $og = Organization::find($orgId);
    $members = self::getMemberNotBelong($orgId);

    return view($this->path . 'members/list', compact('members', 'orgId' , 'og'))
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
    $membership = OrganizationHeadGroup::where('user_id', '=', Auth::user()->id)->get();
    return $membership[0]->organization_id;
  }

  /**
   * Return the list of users not belong to a given
   * organization
   *
   * @param int $id Organization ID
   * @return void
   */
  private function getMemberNotBelong($id)
  {
    return OrganizationGroup::with([
        'user' => function($query) {
            $query
              ->with(['department', 'course'])
              ->get();
          },
        'position'
      ])->where('organization_id', '!=', $id)->where('user_id', '!=', Auth::user()->id)->where('membership_status', '==', 'yes')
        ->get();
  }
}
