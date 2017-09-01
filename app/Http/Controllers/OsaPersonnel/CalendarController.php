<?php

namespace App\Http\Controllers\OsaPersonnel;

use Auth;
use App\Models\User;
use App\Models\Calendar;
use App\Models\EventType;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\EventCategory;
use App\Http\Controllers\Controller;
use App\Library\OsaPersonnelLibrary as OsaPersonnel;

class CalendarController extends Controller
{
   private $osa_personnel;

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
     $this->middleware('web');
     $this->osa_personnel = new OsaPersonnel();
     $this->osa_personnel = new OsaPersonnel();
   }

  public function calendar()
  {
    # Check if the user is loggedin
    parent::loginCheck();

    # is adviser?
    $this->osa_personnel->isOsaPersonnel();

    # Display the calendar
    return view('pages/users/osa-user/calendars/my-org-calendar');
  }
}
