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
    private $name   = [];

    /**
     * Build object
     */
    public function __construct() {

    }

    /**
     * Send Event reminder to user for the upcoming event
     *
     * @return void
     */
    public function index() {
      # include class for beatiful mailer
      $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
      
      # Get the approve events within this year, this comming month
      # and this coming days with the event organizer (e.g APO)
      $event = self::getEvents(); 

      # From the given organization ID for each event
      # get the members
      foreach ($event as $key => $value) {
        # gather organization member emails
        self::getUser($value);

        $month = date('m', strtotime($value->date_start));
        $day   = date('d', strtotime($value->date_start)) - date('d');

        if ($month == date('m') AND ($day == 1 OR $day == 2 OR $day == 3)) {
          # Send an email to user
          self::sendEmails($beautymail, $value);
        }

        if ($month > date('m')) {
          # Send an email to user
          self::sendEmails($beautymail, $value);
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
          $this->name[$value->user->id] = $value->user->first_name . " " . $value->user->last_name;
        }
      }
    }

    /**
     * Return the list of upcoming events
     *
     * @return array|object
     */
    private function getEvents()
    {
      return Event::with('organization')
        ->where('status', 'upcoming')
        ->where('approve_status', 'approved')
        ->whereYear("date_start", '=', date('Y'))
        ->whereMonth('date_start','>=',date('m'))
        ->get();
    }

    /**
     * Return the list of users, a member(s) of the organization
     * that organize the event
     *
     * @return void
     */
    private function getUser($value)
    {
      $organizationGroup = OrganizationGroup::with('user')
        ->where('organization_id', $value->organization->id)
        ->get();

      $attendance = UserAttendance::with('user')
        ->where('event_id', $value->id)
        ->where('status', 'true')
        ->get();

      self::gatheringEmails($organizationGroup); 
      self::gatheringEmails($attendance);
    }

    /**
     * Send Email to users
     */
    private function sendEmails($mail, $value)
    {
      # Send an email to user
      $mail->send('emails.mail', ['event' => $value], function($message)
      { 
        foreach ($this->emails as $key => $email) {
          $message 
            ->to($email, $this->name[$key]) 
            ->subject('You have a new event reminder!'); 
        }
      }); 
    }
}
