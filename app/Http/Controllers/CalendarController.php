<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

  public function universityCalendar(){
    return view('pages.users.organization-head.calendars.university-calendar');
  }
  public function allOrgsCalendar(){
    return view('pages.users.organization-head.calendars.all-orgs-calendar');
  }
  public function myOrgCalendar(){
    return view('pages.users.organization-head.calendars.my-org-calendar');
  }
  public function myPersonalCalendar(){
    return view('pages.users.organization-head.calendars.my-personal-calendar');
  }
}
