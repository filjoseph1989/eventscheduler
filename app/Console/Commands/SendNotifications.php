<?php

namespace App\Console\Commands;

# Illuminate
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

# app
use App\Mail\ApproveEmailNotification;

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
}
