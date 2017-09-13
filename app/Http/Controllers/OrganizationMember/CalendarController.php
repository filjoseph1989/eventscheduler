<?php

namespace App\Http\Controllers\OrganizationMember;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\OrgMemberLibrary as OrgMember;

# Model
use App\Models\OrganizationGroup;
use App\Models\User;
use App\Models\Event;

class CalendarController extends Controller
{
  private $org_member;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('web');
    $this->org_member = new OrgMember();
  }

  /**
   * Display the calendar based on the clicked organization
   * in the list of organization.
   *
   * Using organization ID to get the event from the events
   * table
   *
   * @param  int $id Event Category
   * @return \Illuminate\Response
   */
  public function calendar($id = null)
  {
    # Check if the user is loggedin
    parent::loginCheck();

    # is co-adviser?
    $this->org_member->isOrgMember();

    $login_type = "user";
    # Display the calendar
    return view('pages/users/organization-member/calendars/my-org-calendar', compact(
      'id', 'login_type'
    ));
  }

  /**
   * Display the organization a user belong
   *
   * @return void
   */
  public function calendarWithin()
  {
    # Check if the user is loggedin
    parent::loginCheck();

    # is co-adviser?
    $this->org_member->isOrgMember();

    $organization = OrganizationGroup::with('organization')
      ->where('user_id', '=', Auth::user()->id)
      ->get();

    $login_type = "user";
    return view('pages/users/organization-member/organization/list1', compact(
      'organization', 'login_type'
    ));
  }

}
