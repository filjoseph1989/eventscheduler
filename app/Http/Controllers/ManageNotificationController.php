<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Event;
use App\Mail\Mailtrap;
use App\Models\EventType;
use App\Models\Organization;
use App\Models\OrganizationGroup;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\Mail;
use Thujohn\Twitter\Facades\Twitter;
use App\Notifications\FacebookPublished;

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
        self::notifyViaFacebook($ev);
    }

    if( $ev->notify_via_twitter == 'on'  ){
        // self::notifyViaTwitter($ev);
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
    if( $value->notify_via_twitter == 'on'  ){

      if($value->event_category_id == 1){
        $notification_message = "Hello UP Mindanao! You have an upcoming event! ".
        "{$value->title} headed by {$value->org_name}.".
        " Venue: {$value->description}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
      }

      if($value->event_category_id == 2){
        $notification_message = "Hello {$value->org_name}! You have an upcoming event! ".
        "{$value->title}".
        " Venue: {$value->description}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
      }

      if($value->event_category_id == 3){
        $notification_message = "Hello Student Leaders! You have an upcoming event!".
        "{$value->title} headed by {$value->org_name}".
        " Venue: {$value->description}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
      }

      if($value->event_category_id == 4){
        $notification_message = "Hello {$value->fname}! Your {$value->title} event has been approved. ".
        " Venue: {$value->description}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
      }
      // dd($notification_message);
      // if($notification_message.length < 160)
      return Twitter::postTweet(['status' => $notification_message, 'format' => 'json']);
    }
  }

  private function notifyViaEmail($value) {
    // Demo
    // Mail::to('janicalizdeguzman@gmail.com')->send(new Mailtrap());
    $org = OrganizationGroup::where('organization_id', '=', $value->organization_id)->get();

    $old = [];
    foreach ($org as $key => $value) {
      // d(User::find($value->user_id)->email);
      if ( ! isset($old[$value->user_id])) {
        $old[$value->user_id] = $value->user_id;
        if( $value->notify_via_email == 'on' ){
          Mail::to(User::find($value->user_id)->email)->send(new Mailtrap());
        }
      }
    }
  }

  private function notifyViaSms ($value) {
    if( $value->notify_via_sms == 'on' ) {
      if($value->event_category_id == 1) {
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

        $all_users = User::all();
        foreach ($all_users as $key => $value) {
          Nexmo::message()->send([
            'to'   => $value->mobile_number,
            'from' => '639778378388',
            'text' => $notification_message
          ]);
        }
      }

      if($value->event_category_id == 3){
        $notification_message = "Hello Student Leaders! You have an upcoming event!
        \n{$value->title} headed by {$value->organization->name}.
        \nDescription: {$value->description}
        \nVenue: {$value->venue}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
        \n{$value->additional_msg_sms}
        \nPlease be guided accordingly. Thank You!";
      }

      if($value->event_category_id == 4){
        $notification_message = "Hello {$value->fname}! Your {$value->title} event has been approved.
        \nDescription: {$value->description}
        \nVenue: {$value->venue}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
        \n{$value->additional_msg_sms}
        \nPlease be guided accordingly. Thank You!";
      }

    }
  }
}
