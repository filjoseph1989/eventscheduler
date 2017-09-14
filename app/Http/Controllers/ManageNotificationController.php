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

    if( $ev->notify_via_facebook == 'on' ) {
        // self::notifyViaFacebook($ev);
    }

    if( $ev->notify_via_twitter == 'on'  ) {
        // self::notifyViaTwitter($ev);
    }

    if( $ev->notify_via_email == 'on' ) {
      //  self::notifyViaEmail($ev);
    }

    if( $ev->notify_via_sms == 'on' ) {
      self::notifyViaSms($ev);
    }
  }

  /**
   * Make notification on facebook
   *
   * @param  object $value
   * @return
   */
  private function notifyViaFacebook ($value) {
    //if they will like and follow my facebook page,it will show on their feed
    //backlog or version 2 na tng tagging accounts
    //as long as naka indicate ang audience sa event in the post
    if($value->event_category_id == 1){
      //where event_category == among organization
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $pin = mt_rand(10, 99)
          . mt_rand(10, 99)
          . $characters[rand(0, strlen($characters) - 1)];
          // generate a pin based on 2 * 2 digits + a random character
      $fb = str_shuffle($pin);
        // shuffle the result
      $notification_message = "{$fb} Hello UP Mindanao!! You have an upcoming event!
      \n{$value->title} headed by {$value->organization->name}.
      \nDescription: {$value->description}
      \nVenue: {$value->venue}
      \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time} ".
      "\n{$value->additional_msg_facebook}" .
      "\nPlease be guided accordingly. Thank You!";
    }

    if($value->event_category_id == 2){
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $pin = mt_rand(10, 99)
          . mt_rand(10, 99)
          . $characters[rand(0, strlen($characters) - 1)];
          // generate a pin based on 2 * 2 digits + a random character
      $fb = str_shuffle($pin);
        // shuffle the result
      $notification_message = "{$fb} Hello {$value->organization->name}! You have an upcoming event!
      \n{$value->title}
      \nDescription: {$value->description}
      \nVenue: {$value->venue}
      \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}".
      "\n{$value->additional_msg_facebook}" .
      "\nPlease be guided accordingly. Thank You!";
    }

    if($value->event_category_id == 3){
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $pin = mt_rand(10, 99)
          . mt_rand(10, 99)
          . $characters[rand(0, strlen($characters) - 1)];
          // generate a pin based on 2 * 2 digits + a random character
      $fb = str_shuffle($pin);
        // shuffle the result
      $notification_message = "{$fb} Hello Student Leaders! You have an upcoming event!
      \n{$value->title} headed by {$value->organization->name}.
      \nDescription: {$value->description}
      \nVenue: {$value->venue}
      \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}".
      "\n{$value->additional_msg_facebook}" .
      "\nPlease be guided accordingly. Thank You!";
    }

    if($value->event_category_id == 4){
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $pin = mt_rand(10, 99)
          . mt_rand(10, 99)
          . $characters[rand(0, strlen($characters) - 1)];
          // generate a pin based on 2 * 2 digits + a random character
      $fb = str_shuffle($pin);
        // shuffle the result
      $notification_message = "{$fb} Hello {$value->fname}! Your {$value->title} event has been approved.
      \nDescription: {$value->description}
      \nVenue: {$value->venue}
      \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}".
      "\n{$value->additional_msg_facebook}" .
      "\nPlease be guided accordingly. Thank You!";
    }
    $data['fb_message'] = $notification_message;
    $result = User::send($data['fb_message']);
  }

  private function notifyViaTwitter ($value) {
    //if they will follow my twitter account,it will show on their feed
    //backlog or version 2 na tng tagging accounts
    //as long as naka indicate ang audience sa event in the post

      if($value->event_category_id == 1){
        //where event_category == public view
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(10, 99)
            . mt_rand(10, 99)
            . $characters[rand(0, strlen($characters) - 1)];
            // generate a pin based on 2 * 2 digits + a random character
        $tweet = str_shuffle($pin);
          // shuffle the result
        $notification_message = "{$tweet} Hello UP Mindanao!! You have an upcoming event! ".
        "{$value->title} headed by {$value->organization->name}.".
        " Venue: {$value->venue}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
        $t = str_limit($notification_message, 139);
      }

      if($value->event_category_id == 2){
        //where event_category == within organization
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(10, 99)
            . mt_rand(10, 99)
            . $characters[rand(0, strlen($characters) - 1)];
            // generate a pin based on 2 * 2 digits + a random character
        $tweet = str_shuffle($pin);
          // shuffle the result
        $notification_message = "{$tweet} Hello {$value->organization->name}! You have an upcoming event! ".
        "{$value->title}".
        " Venue: {$value->venue}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
        $t = str_limit($notification_message, 140);
      }

      if($value->event_category_id == 3){
        //where event_category == among organization
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(10, 99)
            . mt_rand(10, 99)
            . $characters[rand(0, strlen($characters) - 1)];
            // generate a pin based on 2 * 2 digits + a random character
        $tweet = str_shuffle($pin);
          // shuffle the result
        $notification_message = "{$tweet} Hello Student Leaders! You have an upcoming event!".
        "{$value->title} headed by {$value->organization->name}".
        " Venue: {$value->venue}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
        $t = str_limit($notification_message, 140);
      }

      if($value->event_category_id == 4){
        //where event_category == my own event
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(10, 99)
            . mt_rand(10, 99)
            . $characters[rand(0, strlen($characters) - 1)];
            // generate a pin based on 2 * 2 digits + a random character
        $tweet = str_shuffle($pin);
          // shuffle the result
        $notification_message = "{$tweet} Hello {$value->fname}! Your {$value->title} event has been approved. ".
        " Venue: {$value->venue}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
        $t = str_limit($notification_message, 140);
      }
      return Twitter::postTweet(['status' => $t, 'format' => 'json']);
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
        $heading = "Hello {$value->organization->name}! You have an upcoming event!";
        break;

      case 3:
        $heading = "Hello Student Leaders! You have an upcoming event!";
        break;

      case 4:
        $heading = "Hello {$value->fname}! Your {$value->title} event has been approved.";
        break;
    }

    return $heading .
      "\n{$event->title} headed by {$event->organization->name}." .
      "\nDescription: {$event->description}" .
      "\nVenue: {$event->venue}" .
      "\nDuration: {$event->date_start}, {$event->date_start_time} to {$event->date_end}, {$event->date_end_time} " .
      "\n{$event->additional_msg_sms}" .
      "\nPlease be guided accordingly. Thank You!";
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
