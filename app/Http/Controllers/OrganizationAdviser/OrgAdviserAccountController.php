<?php

namespace App\Http\Controllers\OrganizationAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController as User;

# Models
use App\Models\OrganizationGroup;
use App\Models\OrganizationAdviserGroup;

/**
 * This controller serve as a shared controller to all controller for
 * organization adviser http request.
 *
 * It contains methods that where commonly used among controllers
 *
 * @author Liz N <janicaliznawa@gmail.com>
 * @since 0.1.0
 * @version 0.2
 * @updated 2017-07-29
 */
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

  /**
   * A private method where it determine if the user currently
   * loggedin in the system is an adviser, return home if not.
   *
   * @return boolean
   */
  public function isAdviser()
  {
    if (! parent::isOrgAdviser()) {
      return redirect()->route('home');
    }
  }

  /**
   * Determine if the event information is valid for
   * database storage
   *
   * @param  object  $data
   * @return boolean
   */
  public function isValid($data)
  {
    $message = [
      'regex' => "Time should be valid format",
    ];

    $this->validate($data, [
      'title'           => 'Required',
      'description'     => 'Required',
      'venue'           => 'Required',
      'date_start'      => 'required|date|after_or_equal:today',
      'date_end'        => 'nullable|date|after_or_equal:date_start',
      'date_start_time' => 'filled|date_format:H:i',
      'date_end_time'   => 'nullable|date_format:H:i',
    ], $message);
  }

  /**
   * return true if this account is an adviser to the
   * given organization ID
   *
   * @return
   */
  public function isAdviserInGivenOrganization($id)
  {
    $adviser = OrganizationAdviserGroup::where('organization_id', '=', $id)->get();
  }
}
