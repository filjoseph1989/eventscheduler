<?php

namespace App\Http\Controllers\OrganizationAdviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\OrgAdviserLibrary as Adviser;

class CalendarController extends Controller
{
  private $adviser;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('web');
    $this->adviser = new Adviser();
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
  public function calendar()
  {
    # Check if the user is loggedin
    parent::loginCheck();

    # is adviser?
    $this->adviser->isAdviser();

    # Display the calendar
    return view('pages/users/organization-adviser/calendars/my-org-calendar');
  }

}
