<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

#Models
use App\Models\User;
use App\Models\Event;
use App\Models\Organization;

class Mailtrap extends Mailable
{
    use Queueable, SerializesModels;

    protected $event;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $value)
    {
        $this->event = $value;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      if($this->event->event_category_id == 1){
        //where event_category == public view
        $notification_message =
        "Hello UP Mindanao! You have an upcoming event!
        \n{$this->event->title} headed by {$this->event->organization->name}.
        \nDescription: {$this->event->description}
        \nVenue: {$this->event->venue}
        \nDuration: {$this->event->date_start}, {$this->event->date_start_time} to {$this->event->date_end}, {$this->event->date_end_time}
        \n{$this->event->additional_msg_sms}
        \nPlease be guided accordingly. Thank You!";

        return $this->view('emails.mail')
        ->with(['notification_message' => $notification_message])
        ->from('ano.user12345@gmail.com');
      }
      if($this->event->event_category_id == 2) {
        //where event_category == within organization
        $notification_message = "Hello {$this->event->organization->name}! You have an upcoming event!
          \n{$this->event->title}
          \nDescription: {$this->event->description}
          \nVenue: {$this->event->venue}
          \nDuration: {$this->event->date_start}, {$this->event->date_start_time} to {$this->event->date_end}, {$this->event->date_end_time}
          \n{$this->event->additional_msg_sms}
          \nPlease be guided accordingly. Thank You!";

          return $this->view('emails.mail')
          ->with(['notification_message' => $notification_message])
          ->from('ano.user12345@gmail.com');
      }
      if($this->event->event_category_id == 3){
        //where event_category == among organization
        $notification_message = "Hello Student Leaders! You have an upcoming event!
        \n{$this->event->title} headed by {$this->event->organization->name}.
        \nDescription: {$this->event->description}
        \nVenue: {$this->event->venue}
        \nDuration: {$this->event->date_start}, {$this->event->date_start_time} to {$this->event->date_end}, {$this->event->date_end_time}
        \n{$this->event->additional_msg_sms}
        \nPlease be guided accordingly. Thank You!";
        return $this->view('emails.mail')
        ->with(['notification_message' => $notification_message])
        ->from('ano.user12345@gmail.com');
      }
    }
}
