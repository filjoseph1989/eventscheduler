<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

# Models
use App\Models\User;
use App\Models\Event;
use App\Models\UserAttendance;
use App\Models\OrganizationGroup;

/**
 * Send email notification
 * 
 * @author Janiza Liz De Guzman <janicalizdeguzman@gmail.com>
 * @author Fil Beluan <filjoseph22@gmail.com>
 */
class SendNotifications extends Command
{
    private $emails    = [];
    private $user_name = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendNotifications:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send notification about upcomming events to users email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * The functionality here is intended only for
     * email and mobile only, because facebook and twitter doesn't allow
     * posting same post
     *
     * @return mixed
     */
    public function handle()
    {
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

        # Send an email reminder to user
        if ($month == date('m') AND ($day == 1 OR $day == 2 OR $day == 3)) {
          self::sendEmails($beautymail, $value);
        }

        # Issue 77

        $this->emails    = []; # reset
        $this->user_name = []; # reset
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
          $this->name[$value->user->id]   = $value->user->first_name . " " . $value->user->last_name;
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
      $mail->send('emails.mail1', ['event' => $value], function($message)
      {
        foreach ($this->emails as $key => $e) {
          $message
            ->to($e, $this->name[$key])
            ->subject('You have a new event reminder!');
        }
      });
    }
}
