<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MailController;

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
     * @return mixed
     */
    public function handle()
    {
        /**
         * Steps to take
         *
         * I think, this functionality should be in mobile and email only, because
         * notification about the event is already posted on social media the an event is approved,
         * and social prevent same notification over and over -- haha
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
