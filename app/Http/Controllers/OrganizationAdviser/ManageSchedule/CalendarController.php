<?php

namespace App\Http\Controllers\OrganizationAdviser\ManageSchedule;

use Illuminate\Http\Request;
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
    parent::loginCheck();

    if (parent::isOrgAdviser()) {
      # To get the organization name
      $org = Organization::find($id);

      # Display the calendar
      return view(
        'pages/users/organization-adviser/calendars/my-org-calendar',
        compact( 'org' )
      );
    } else {
      return redirect()->route('home');
    }
  }

}
