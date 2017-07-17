<?php

namespace app\Http\Controllers\OrganizationMember\ManageSchedule;

use Auth;
use App\Models\User;
use App\Models\Calendar;
use App\Models\EventType;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\Organization;
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
   * @return void
   */
  public function myOrgCalendar($id)
  {
    $org = Organization::find($id);

    # Display the calendar
    return view(
      'pages.users.organization-member.calendars.my-org-calendar',
      compact(
        'org'
      )
    );
  }

  /**
   * Display the user personal calendar
   * @return
   */
  public function myPersonalCalendar(){
    return view('pages.users.organization-head.calendars.my-personal-calendar');
  }
}
