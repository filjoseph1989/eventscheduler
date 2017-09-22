<?php

namespace App\Http\Controllers;

use Auth;
use Nexmo\Laravel\Facade\Nexmo;
use Thujohn\Twitter\Facades\Twitter;
use App\Notifications\FacebookPublished;

use App\Mail\Mailtrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

#models
use App\Models\User;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Organization;
use App\Models\OrganizationGroup;
use App\Models\EventCategory;
class ManageNotificationController extends Controller
{
  private $twitter = false;

  /**
   * This method will send notification on different media
   *
   * Issue Column not found: 1054 Unknown column 'events.event' in 'field list'
   *
   * @param  Request $data [description]
   * @return
   */
  public function notify($approved_event) {
    $ev = $approved_event;

    # Make a formatted date
    $ev->date_start = date("d M Y",strtotime($ev->date_start));
    $ev->date_end   = date("d M Y",strtotime($ev->date_end));

    if ($ev->notify_via_facebook == 'on') {
      self::notifyViaFacebook($ev);
    }

    if ($ev->notify_via_twitter == 'on') {
      $pwde = self::notifyViaTwitter($ev);
    }

    if ($ev->notify_via_email == 'on') {
      self::notifyViaEmail($ev);
    }

    if ($ev->notify_via_sms == 'on') {
      self::notifyViaSms($ev);
    }
  }

  /**
   * Make notification on facebook
   *
   * @param  object $value
   * @return
   */
  private function notifyViaFacebook ($event) {
    $data['fb_message'] = self::smsMessage($event->event_category_id, $event);
    User::send($data['fb_message']);
  }

  /**
   * Tweet if the event has been approved
   *
   * if they will follow my twitter account,it will show on their feed
   * backlog or version 2 na tng tagging accounts
   * as long as naka indicate ang audience sa event in the post
   *
   * @param  object $value Event
   * @return void
   */
  private function notifyViaTwitter ($value) {
    $this->twitter = true;
    $tweet = self::twitterMessage($value);
    $this->twitter = false;
    return Twitter::postTweet(['status' => $tweet, 'format' => 'json']);
  }

  /**
   * make tweet
   *
   * @return void
   */
  private function twitterMessage($event)
  {
    $message = self::smsMessage($event->event_category_id, $event);
    return str_limit($message, 100);
  }

  /**
   * Send email notification after an event is approve
   *
   * @param object $value Event
   * @return void
   */
  private function notifyViaEmail($value) {
      if($value->event_category_id == 1) {
        $users = User::all();
      }

      if($value->event_category_id == 2) {
        $users = OrganizationGroup::with('user')
          ->where('organization_id', '=', $value->organization_id )
          ->get();
      }

      if($value->event_category_id == 3){
        $users = OrganizationGroup::with('user')->get();
      }

      self::sendEmail($users);
  }

  /**
   * Send email
   *
   * @return void
   */
  private function sendEmail($users)
  {
    foreach($users as $key => $val ) {
      Mail::to($val->user->email)->send(new Mailtrap($value));
    }
  }

  /**
   * Send sms message when the event is approve
   *
   * @param  object $value event
   * @return void
   */
  private function notifyViaSms($event) {
    # Composr message
    $notification_message = self::smsMessage($event->event_category_id, $event);

    # Public event
    if($event->event_category_id == 1) {
      $users = User::all();
    }

    # Within organization
    if($value->event_category_id == 2) {
      $users = OrganizationGroup::with('user')
          ->where('organization_id', '=', $value->organization_id )
          ->get();
    }

    # Among organization
    if($value->event_category_id == 3){
      $users = OrganizationGroup::with('user')->get();
    }

    # Personal event
    if($value->event_category_id == 4){
      $notification_message = self::smsMessage($value->event_category_id, $event);
    }

    # Send notification
    self::sendSms($users, $notification_message);
  }

  /**
   * Return a formatted short message from event
   * @return string
   */
  private function smsMessage($category, $event)
  {
    switch ($category) {
      case 1:
        $heading = "Hello UP Mindanao! You have an upcoming event! ";
        break;

      case 2:
        $heading = "Hello {$event->organization->name}! You have an upcoming event!";
        break;

      case 3:
        $heading = "Hello Student Leaders! You have an upcoming event!";
        break;

      case 4:
        $heading = "Hello {$event->fname}! Your {$value->title} event has been approved.";
        break;
    }

    $new_line = "";
    if (! $this->twitter) {
      $new_line = "\n";
    }

    $heading .=
      "{$new_line}{$event->title} headed by {$event->organization->name}.";
      if (! $this->twitter) {
        $heading .= "{$new_line}Description: {$event->description}";
      }

    $heading .=
      "{$new_line}Venue: {$event->venue}" .
      "{$new_line}Duration: {$event->date_start}, {$event->date_start_time} to {$event->date_end}, {$event->date_end_time} " .
      "{$new_line}{$event->additional_msg_sms}" .
      "{$new_line}Please be guided accordingly. Thank You!";

    return $heading;
  }

  /**
   * Send short message using nexmo
   *
   * @return void
   */
  private function sendSms($users, $notification_message)
  {
    foreach($users as $key => $user) {
      Nexmo::message()->send([
        'to'   => $user->user->mobile_number,
        'from' => '639778378388',
        'text' => $notification_message
      ]);
    }
  }
}
