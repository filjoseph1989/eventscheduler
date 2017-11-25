<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

/**
 * Make facebook post
 */
class FaceBookNotification extends Notification
{
    use Queueable;

    private $message;

    private $picture;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $picture = '')
    {
        $this->message = $message;
        $this->picture = $picture;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FacebookPosterChannel::class];
    }

    /**
     * Provide a facebook message
     *
     * @param string $notifiable
     * @return object
     */
    public function toFacebookPoster($notifiable) {
      if ($this->picture != '' AND file_exists("img/social/{$this->picture}")) {
        return (new FacebookPosterPost($this->message))
          ->withImage(url("/img/social/{$this->picture}"));
          // ->withImage(url("https://i.imgur.com/GGfTdwZ.png"));
      } else {
        return new FacebookPosterPost($this->message);
      }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
          ->line('The introduction to the notification.')
          ->action('Notification Action', url('/'))
          ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
