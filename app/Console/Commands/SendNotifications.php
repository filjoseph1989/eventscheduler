<?php

namespace App\Console\Commands;

# Illuminate
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

# packages
use Nexmo\Laravel\Facade\Nexmo;
use Thujohn\Twitter\Facades\Twitter;

# app
use App\Mail\ApproveEmailNotification;
use App\Notifications\FacebookPublished;
use App\Common\CommonMethodTrait;

# models
use App\Models\Event;
use App\Models\Attendance;
use App\Models\OrganizationGroup;

/**
 * Send event reminder in the background
 *
 * @author Janica Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @date 11-05-2017
 * @date 11-05-2017 - updated
 */
class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sent a reminder of the event to organization members';

    /**
     * email handle
     * @var array
     */
    private $emails    = [];

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
     * @return mixed
     */
    public function handle()
    {
        foreach (self::getEvents() as $key => $event) {
          self::getUser($event);

          $month = date('m', strtotime($event->date_start));
          $day   = date('d', strtotime($event->date_start)) - date('d');

          # Send an email reminder to user
          if ($month == date('m') AND ($day == 1 OR $day == 2 OR $day == 3)) {
            self::sendEmail($event);
            self::facebookPost($event);
            self::twitterPost($event);
            self::smsPost($event);
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
            ->where(function($query) {
                $query
                  ->where('category', 'organization')
                  ->orWhere('category', 'within');
            })
            ->where('status', 'upcoming')
            ->where('is_approve', 'true')
            ->whereYear("date_start", '=', date('Y'))
            ->whereMonth('date_start','>=',date('m'))
            ->get();
    }

    /**
     * collect the list of user in an event
     *
     * @param  object $event
     * @return
     */
    private function getUser($event)
    {
      $organizationGroup = OrganizationGroup::with('user')
        ->where('organization_id', $event->organization->id)
        ->get();

      $attendance = Attendance::with('user')
        ->where('event_id', $event->id)
        ->where('status', 'confirmed')
        ->get();

      self::gatheringEmails($organizationGroup);
      self::gatheringEmails($attendance);
    }

    /**
     * Gather user emails
     *
     * @param  object $data
     * @return object
     */
    private function gatheringEmails($data)
    {
      foreach ($data as $key => $value) {
        if (! isset($this->emails[$value->user->id])) {
          $this->emails[$value->user->id] = $value->user->email;
        }
      }
    }

    /**
     * Send emails
     *
     * @param  object $event
     * @return void
     */
    private function sendEmail($event)
    {
      foreach($this->emails as $key => $email) {
        Mail::to($email)
          ->send(new ApproveEmailNotification($event));
      }
    }

    /**
     * Send notification on facebook
     *
     * @param  object $event
     * @return void
     */
    private function facebookPost($event) {
      $data['fb_message'] = self::smsMessage($event->category, $event);
      User::send($data['fb_message']);
    }

    /**
     * Twitter notification
     * this will post to Schedule Handler Twitter Account
     * @param object $event
     * @return void
     */
    protected function twitterPost($event)
    {
      $tweet = self::twitterMessage($event);

      return Twitter::postTweet([
        'status' => $tweet,
        'format' => 'json'
      ]);
    }

    /**
     * make tweet
     *
     * @return void
     */
    private function twitterMessage($event)
    {
      $message = self::smsMessage($event->category, $event, true);
      return str_limit($message, 100);
    }

    /**
    * SMS notification
    *
    * @param object $event
    * @return void
    */
   protected function smsPost($event)
   {
      # Composr message
      $message = self::smsMessage($event->category, $event);

      # Public event
      if($event->category == 'university' OR $event->category == 'organization') {
       $users = User::where('status', 'true')->get();
      }

      # Within organization
      if($event->category == 'within') {
       $users = OrganizationGroup::with('user')
         ->with('organization')
         ->where('organization_id', $event->organization_id )
         ->get();
      }

      # Send notification
      self::sendSms($users, $message, $event);
   }

   /**
    * Send text messages
    *
    * @param  obj $users
    * @param  string $notification_message
    * @return void
    */
   private function sendSms($users, $message, $event)
   {
     if( $event->category == 'university' OR $event->category == 'organization' ) {
       foreach($users as $key => $user) {
         Nexmo::message()->send([
           'to'   => $user->mobile_number,
           'from' => '639778378388',
           'text' => $message
         ]);
       }
     } else {
       foreach($users as $key => $user) {
         Nexmo::message()->send([
           'to'   => $user->user->mobile_number,
           'from' => '639778378388',
           'text' => $message
         ]);
       }
     }
   }

    /**
     * Compose a message
     *
     * @param  string $category
     * @param  object $event
     * @return string
     */
    private function smsMessage($category, $event, $twit = false)
    {
      switch ($category) {
        case 'university':
          $heading = "Hello UP Mindanao! You have an upcoming event! ";
          break;

        case 'within':
          $heading = "Hello {$event->organization->name}! You have an upcoming event!";
          break;

        case 'organization':
          $heading = "Hello Student Leaders! You have an upcoming event!";
          break;
      }

      $new_line = "";
      if ($twit === true) {
        $new_line = "\n";
      }

      $heading .= "{$new_line}{$event->title} headed by {$event->organization->name}.";

      if ($twit === true) {
        $heading .= "{$new_line}Description: {$event->description}";
      }

      $heading .=
        "{$new_line}Venue: {$event->venue}" .
        "{$new_line}Duration: {$event->date_start}, {$event->date_start_time} to {$event->date_end}, {$event->date_end_time} " .
        "{$new_line}{$event->additional_msg_sms}" .
        "{$new_line}Please be guided accordingly. Thank You!";

      return $heading;
    }
}
