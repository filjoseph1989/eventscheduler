<?php

namespace App\Http\Controllers\OrganizationHead;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\OrgHeadLibrary as OrgHead;

# Models
use App\Models\User;
use App\Models\Calendar;
use App\Models\EventType;
use App\Models\Organization;
use App\Models\EventCategory;
use App\Models\OrganizationGroup;


class CalendarController extends Controller
{
  private $orgHead;

  /**
   * Create controller instance
   */
  public function __construct()
  {
    $this->middleware('web');
    $this->orgHead = new OrgHead();
  } 

  /**
   * Display the event calendar
   *
   * @param int $id Event Category
   * @return void
   */
  public function calendar($id = null)
  {
    # Check if the user is loggedin
    parent::loginCheck();

    # is adviser?
    $this->orgHead->isOrgHead();

    $login_type = "user";

    # Display the calendar
    return view('pages/users/organization-head/calendars/my-org-calendar', compact(
      'login_type', 'id'
    )); 
  }

  /**
   * Display the event within the organization
   * of the login user
   *
   * @return void
   */
  public function calendarWithin()
  {
    # Check if the user is loggedin
    parent::loginCheck();

    # is adviser?
    $this->orgHead->isOrgHead();

    $organization = OrganizationGroup::with('organization')
      ->where('user_id', '=', Auth::user()->id)
      ->get();

    $login_type = "user";
    return view('pages/users/organization-head/organization/list1', compact(
      'organization', 'login_type'
    ));
  } 
}
