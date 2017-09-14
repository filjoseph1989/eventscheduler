<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Nexmo\Laravel\Facade\Nexmo;

# Models
use App\Models\User;
use App\Models\Event;
use App\Models\UserAttendance;
use App\Models\OrganizationGroup;

/**
 * The class task is to send sms notification about the
 * upcoming event
 *
 * @author Janica Liz D Guzman
 * @version 1.0
 * @date 09-13-2017
 * @updated 09-13-2017
 */
class SendSms extends Command
{
    private $mobile = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send sms to member of the organization about the upcoming event';

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
      $events = self::getEvents();

      foreach ($events as $key => $event) {
        self::getUser($event);

        $month = date('m', strtotime($event->date_start));
        $day   = date('d', strtotime($event->date_start)) - date('d');

        # Send an sms reminder to user
        if ($month == date('m') AND ($day == 1 OR $day == 2 OR $day == 3)) {
          self::send($event);
        }

        # Issue 77

        $this->mobile = []; # reset list
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
    private function getUser($event)
    {
      $organizationGroup = OrganizationGroup::with('user')
        ->where('organization_id', $event->organization->id)
        ->get();

      $attendance = UserAttendance::with('user')
        ->where('event_id', $event->id)
        ->where('status', 'true')
        ->get();

      self::getMobileNo($organizationGroup);
      self::getMobileNo($attendance);
    }

    /**
     * Get the mobile number of the user
     *
     * @param  object $data user details
     * @return void
     */
    private function getMobileNo($data)
    {
      foreach ($data as $key => $value) {
        if (! isset($this->mobile[$value->user->id])) {
          $this->mobile[$value->user->id] = $value->user->mobile_number;
        }
      }
    }

    /**
     * Send sms notification remider to given
     * mobile number
     *
     * @param  int $mobileNumber
     * @param  int $message
     * @return void
     */
    private function send($event)
    {
      $message = self::formatMessage($event);

      foreach ($this->mobile as $key => $number) {
        Nexmo::message()->send([
          'to'   => $number,
          'from' => '639778378388',
          'text' => "$message"
        ]);
      }
    }

    /**
     * Create a formatted message from the given
     * event
     *
     * @return string $message
     */
    private function formatMessage($event)
    {
      return
        "Hello UP Mindanao! You have an upcoming event! " .
        "\n{$event->title} headed by {$event->organization->name}." .
        "\nDescription: {$event->description}" .
        "\nVenue: {$event->venue}" .
        "\nDuration: {$event->date_start}, {$event->date_start_time} to {$event->date_end}, {$event->date_end_time} " .
        "\n{$event->additional_msg_sms}" .
        "\nPlease be guided accordingly. Thank You!";
    }
}
