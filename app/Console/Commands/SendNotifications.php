<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use App\Http\Controllers\MailController;


use Auth;
use Illuminate\Support\Facades\Mail;

# MAiler
use App\Mail\EmailNotification;

# Models
use App\Models\User;
use App\Models\Event;
use App\Models\OrganizationGroup;
use App\Models\UserAttendance;

class SendNotifications extends Command
{
    private $emails = [];
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
    protected $description = 'This will send notification about upcomming events to facebook, twitter, email and mobile';

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
        # Send an email to user
        $beautymail->send('emails.mail', ['event' => $value], function($message)
        { 
          foreach ($this->emails as $key => $email) {
            $message 
              ->to($email, $this->user_name[$key]) 
              ->subject('You have a new event reminder!'); 
          }
        });
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
          $this->user_name[$value->user->id] = $value->user->first_name . " " . $value->user->last_name;
        }
      }
    }
}
