<?php

namespace App\Http\Controllers\OrganizationAdviser\ManageSchedule;

use Auth;
use App\Models\User;
use App\Models\Calendar;
use App\Models\EventType;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\EventCategory;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
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

  /**
   * Display the university calendar
   * @return void
   */
  public function universityCalendar(){
    return view('pages.users.organization-head.calendars.university-calendar');
  }

  /**
   * Display the calendar for all organizations
   * @return
   */
  public function allOrgsCalendar(){
    return view('pages.users.organization-head.calendars.all-orgs-calendar');
  }

  /**
   * Display the organization calendar the user belong to
   *
   * ! Depracated function
   *
   * @return void
   */
  public function _myOrgCalendar()
  {
    $event_type       = EventType::all();
    $event_categories = EventCategory::all();
    $calendar         = Calendar::all();

    # get organization name and id
    $user = new User();
    $user = $user->select('organization_groups.organization_id', 'organizations.name')
      ->join('organization_groups', 'organization_groups.user_id', '=', 'users.id')
      ->join('organizations', 'organization_groups.organization_id', '=', 'organizations.id')
      ->where('organization_groups.user_id', '=', Auth::user()->id)
      ->get();

    # Display the calendar
    return view(
      'pages.users.organization-head.calendars.my-org-calendar',
      compact(
        'event_type',
        'event_categories',
        'calendar',
        'user'
      )
    );
  }

  /**
   * Display the calendar based on the clicked organization
   * in the list of organization.
   *
   * Using organization ID to get the event from the events
   * table
   *
   * @param  int $id Organization ID
   * @return \Illuminate\Response
   */
  public function myOrgCalendar($id)
  {
    # Check if the user is loggedin
    if (! Auth::check()) {
      return redirect()->route('login');
    }

    if (parent::isOrgHead()) {
      # To get the organization name
      $org = Organization::find($id);

      # Display the calendar
      return view(
        'pages.users.organization-head.calendars.my-org-calendar',
        compact( 'org' )
      );
    } else {
      return redirect()->route('home');
    }
  }

  /**
   * Display the user personal calendar
   * @return
   */
  public function myPersonalCalendar() {
    # Check if the user is loggedin
    if (! Auth::check()) {
      return redirect()->route('login');
    }

    if (parent::isOrgHead()) {
      return view('pages.users.organization-head.calendars.my-personal-calendar');
    }
  }
}
