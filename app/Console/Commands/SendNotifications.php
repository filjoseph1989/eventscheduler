<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MailController;

# Models
use App\Models\Event;

class SendNotifications extends Command
{
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
      /**
       * Steps to take
       *
       * 1. get the upcomming approve events
       * 2. get the organizer of the events (e.g Alpha Pi Omega)
       * 3. get the member of the events and other attendees base on the user attendance table
       *      - Get users on attendance table where status is true
       * 4. Given the data and time from the events send notification every week and 1 day prior to the event
       *      - Notification on weekly bases, the date of sending notification must be less than the date of the event
       *      - Similar for the day ahead, the date must be less than the date of the event
       */ 
      $mail = new MailController();
      $mail->index();
    }
}
