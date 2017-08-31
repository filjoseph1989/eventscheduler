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

    if( $ev->notify_via_facebook == 'on' ){
        // self::notifyViaFacebook($ev);
    }

    if( $ev->notify_via_twitter == 'on'  ){
        self::notifyViaTwitter($ev);
    }

    if( $ev->notify_via_email == 'on' ) {
      //  self::notifyViaEmail($ev);
    }

    if( $ev->notify_via_sms == 'on' ){
      // self::notifyViaSms($ev);
    }
  }

  /**
   * Make notification on facebook
   *
   * @param  object $value
   * @return
   */
  private function notifyViaFacebook ($value) {
    if( $value->notify_via_facebook == "on" ){
      if($value->event_category_id == 1){
        $notification_message = "Hello UP Mindanao! You have an upcoming event!
        \n{$value->title} headed by {$value->organization->name}.
        \nDescription: {$value->description}
        \nVenue: {$value->venue}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time} ".
        "\n{$value->additional_msg_facebook}" .
        "\nPlease be guided accordingly. Thank You!";
      }

      if($value->event_category_id == 2){
        $notification_message = "Hello {$value->organization->name}! You have an upcoming event!
        \n{$value->title}
        \nDescription: {$value->description}
        \nVenue: {$value->venue}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}".
        "\n{$value->additional_msg_facebook}" .
        "\nPlease be guided accordingly. Thank You!";
      }

      if($value->event_category_id == 3){
        $notification_message = "Hello Student Leaders! You have an upcoming event!
        \n{$value->title} headed by {$value->organization->name}.
        \nDescription: {$value->description}
        \nVenue: {$value->venue}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}".
        "\n{$value->additional_msg_facebook}" .
        "\nPlease be guided accordingly. Thank You!";
      }

      if($value->event_category_id == 4){
        $notification_message = "Hello {$value->fname}! Your {$value->title} event has been approved.
        \nDescription: {$value->description}
        \nVenue: {$value->venue}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}".
        "\n{$value->additional_msg_facebook}" .
        "\nPlease be guided accordingly. Thank You!";
      }
      $data['fb_message'] = $notification_message;
      $result = User::send($data['fb_message']);
    }
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
        $notification_message = "{$tweet} Hello UP Mindanao! You have an upcoming event! ".
        "{$value->title} headed by {$value->organization->name}.".
        " Venue: {$value->venue}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
        $t = str_limit($notification_message, 140);
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

  private function notifyViaEmail($value) {
      if($value->event_category_id == 1) {
        //where event_category == public view
        $all_users = User::all()->take(1);
        foreach ($all_users as $key => $val_users) {
          Mail::to($val_users->email)->send(new Mailtrap($value));
        }
      }
      if($value->event_category_id == 2) {
        $all_org_grp = OrganizationGroup::with('user')
        ->where('organization_id', '=', $value->organization_id )
        ->take(1) //just take 1 item from the database that matches the condition
        ->get();
        foreach($all_org_grp as $key => $val ){
            Mail::to($val->user->email)->send(new Mailtrap($value));
        }
      }
      if($value->event_category_id == 3){
        //where event_category == among organization
        $all_org_grp = OrganizationGroup::with('user')
        ->take(1) //just take 1 item from the database that matches the condition
        ->get();
        foreach($all_org_grp as $key => $val ){
            Mail::to($val->user->email)->send(new Mailtrap($value));
        }
      }
  }

  private function notifyViaSms ($value) {
    if($value->event_category_id == 1) {
      //where event_category == public view
      $notification_message =
        "Hello UP Mindanao! You have an upcoming event! " .
        "\n{$value->title} headed by {$value->organization->name}." .
        "\nDescription: {$value->description}" .
        "\nVenue: {$value->venue}" .
        "\nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time} " .
        "\n{$value->additional_msg_sms}" .
        "\nPlease be guided accordingly. Thank You!";
        // $all_users = User::all();
        $all_users = User::all()->take(1);
        foreach ($all_users as $key => $value) {
          Nexmo::message()->send([
            'to'   => $value->mobile_number,
            'from' => '639778378388',
            'text' => $notification_message
          ]);
        }
    }

    if($value->event_category_id == 2) {
      //where event_category == within organization
      $notification_message = "Hello {$value->organization->name}! You have an upcoming event!
        \n{$value->title}
        \nDescription: {$value->description}
        \nVenue: {$value->venue}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
        \n{$value->additional_msg_sms}
        \nPlease be guided accordingly. Thank You!";
        $all_org_grp = OrganizationGroup::with('user')
        ->where('organization_id', '=', $value->organization_id )
        ->take(2) //just take 2 item from the database that matches the condition
        ->get();
        foreach($all_org_grp as $key => $val ){
          Nexmo::message()->send([
                  'to'   => $val->user->mobile_number,
                  'from' => '639778378388',
                  'text' => $notification_message
                ]);
        }
    }

    if($value->event_category_id == 3){
      //where event_category == among organization
      $notification_message = "Hello Student Leaders! You have an upcoming event!
      \n{$value->title} headed by {$value->organization->name}.
      \nDescription: {$value->description}
      \nVenue: {$value->venue}
      \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
      \n{$value->additional_msg_sms}
      \nPlease be guided accordingly. Thank You!";
      $all_org_grp = OrganizationGroup::with('user')
      ->take(3) //just take 1 item from the database that matches the condition
      ->get();
      foreach($all_org_grp as $key => $val ){
        Nexmo::message()->send([
                'to'   => $val->user->mobile_number,
                'from' => '639778378388',
                'text' => $notification_message
              ]);
      }
    }

    if($value->event_category_id == 4){
      //where event_category == my own event
      $notification_message = "Hello {$value->fname}! Your {$value->title} event has been approved.
      \nDescription: {$value->description}
      \nVenue: {$value->venue}
      \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
      \n{$value->additional_msg_sms}
      \nPlease be guided accordingly. Thank You!";
    }
  }
}
