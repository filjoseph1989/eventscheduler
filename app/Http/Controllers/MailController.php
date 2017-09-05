<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

# MAiler
use App\Mail\Mailtrap;
use App\Mail\EmailNotification;

# Models
use App\Models\User;
use App\Models\Event;
use App\Models\OrganizationGroup;
use App\Models\UserAttendance;

class MailController extends Controller
{
    private $emails = [];

    /**
     * Build object
     */
    public function __construct() {

    }
    /**
     * Send email
     * @return
     */
    public function index() {
      # Get the approve events within this year, this comming month
      # and this coming days with the event organizer (e.g APO)
      $event = Event::with('organization')
        ->where('status', 'upcoming')
        ->where('approve_status', 'approved')
        ->whereYear("date_start", '=', date('Y'))
        ->whereMonth('date_start','>=',date('m'))
        ->whereDay('date_start', '>', date('d'))
        ->get();

      # From the given organization ID for each event
      # get the members
      foreach ($event as $key => $value) {
        $organizationGroup = OrganizationGroup::with('user')
          ->where('organization_id', $value->organization->id)
          ->get();

        self::gatheringEmails($organizationGroup);

        $attendance = UserAttendance::with('user')
          ->where('event_id', $value->id)
          ->where('status', 'true')
          ->get();

        self::gatheringEmails($attendance);

        # Send an email to user
        foreach ($this->emails as $key => $email) {
          Mail::to($email)->send(new EmailNotification());
        }
      }

    }

    /**
     * The purpose for this method is to get email from the users
     * @return [type] [description]
     */
    private function gatheringEmails($data)
    {
      foreach ($data as $key => $value) {
        if (! isset($this->emails[$value->user->id])) {
          $this->emails[$value->user->id] = $value->user->email;
        }
      }
    }
}
