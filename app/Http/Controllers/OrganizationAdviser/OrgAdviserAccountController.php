<?php

namespace App\Http\Controllers\OrganizationAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Models\OrganizationGroup;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController as User;

class OrgAdviserAccountController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('web');
  }

  /*
    Issue 38: Review methods below if still in use
   */

  /**
   * Display a list of organization.
   *
   * @return \Illuminate\Http\Response
   */
  public function myOrganization()
  {
    # Is the user login?
    parent::loginCheck();

    # Is the user an organization adviser?
    if (parent::isOrgAdviser()) {
      # Issue 31: Change this to eloquent way of getting data
      # Get the organization base onn the user's ID
      $organization = OrganizationGroup::select(
        'organizations.id',
        'organizations.name'
      )
      ->join('organizations', 'organizations.id', '=', 'organization_groups.organization_id')
      ->where('organization_groups.user_id', '=', Auth::user()->id)
      ->get();

      # View
      $login_type = "user";
      return view(
        'pages/users/organization-adviser/manage_schedule/my-organization',
        compact(
          'login_type',
          'organization'
        )
      );
    } else {
      return redirect()->route('home');
    }
  }

  /**
   * Display the personal calendar
   *
   * @return
   */
  public function myPersonalCalendar()
  {
    # Check if the user is loggedin
    parent::loginCheck();

    if (parent::isOrgAdviser()) {
      return view('pages/users/organization-adviser/calendars/my-personal-calendar');
    }
  }
}
