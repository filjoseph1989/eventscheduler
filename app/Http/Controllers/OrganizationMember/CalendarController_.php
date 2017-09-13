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

// use App\Models\User;
// use App\Models\Calendar;
// use App\Models\EventType;
// use App\Models\Organization;
// use App\Models\EventCategory;

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
   * Display the university calendar
   * @return void
   */
  public function universityCalendar(){
    return view('pages.users.organization-member.calendars.university-calendar');
  }

  /**
   * Display the calendar for all organizations
   * @return
   */
  public function allOrgsCalendar(){
    return view('pages.users.organization-member.calendars.all-orgs-calendar');
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
      'pages.users.organization-member.calendars.my-org-calendar',
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

    if (parent::isOrgMember()) {
      # To get the organization name
      $org = Organization::find($id);

      # Display the calendar
      return view(
        'pages.users.organization-member.calendars.my-org-calendar',
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

    if (parent::isOrgMember()) {
      return view('pages.users.organization-member.calendars.my-personal-calendar');
    }
  }


  public function calendar()
  {
    # Check if the user is loggedin
    parent::loginCheck();

    # is adviser?
    $this->org_member->isOrgMember();

    # Display the calendar
    return view('pages/users/organization-member/calendars/my-org-calendar');
  }
}
