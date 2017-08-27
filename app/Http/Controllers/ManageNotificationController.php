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
  public function notify($approved_event){
    $events = Event::find($approved_event->id);
    $ev     = $events->select(
      'events.id',
      'events.user_id',
      'events.event_type_id',
      'events.event_category_id',
      'events.organization_id',
      'events.title',
      'events.description',
      'events.venue',
      'events.date_start',
      'events.date_end',
      'events.date_start_time',
      'events.date_end_time',
      'events.whole_day',
      'events.status',
      'events.approver_count',
      'organization_groups.user_id as orgg_uid',
      'organizations.name as org_name',
      'users.first_name as fname',
      'events.notify_via_facebook',
      'events.notify_via_twitter',
      'events.notify_via_sms',
      'events.notify_via_email',
      'events.additional_msg_facebook',
      'events.additional_msg_sms',
      'events.additional_msg_email',
      'events.picture_facebook',
      'events.picture_twitter',
      'events.picture_email'
    )
    ->join('organization_groups', 'events.organization_id', '=', 'organization_groups.organization_id')
    ->join('organizations', 'events.organization_id', '=', 'organizations.id')
    ->join('users', 'events.user_id', '=', 'users.id')
    ->where('organization_groups.user_id', '=', Auth::user()->id)
    ->get();

    foreach ($ev as $key => $value) {
      # Make a formatted date
      $value->date_start = date("d M Y",strtotime($value->date_start));
      $value->date_end   = date("d M Y",strtotime($value->date_end));

      if( $value->notify_via_facebook == 'on' ){
      //   self::notifyViaFacebook($value);
      }

      if( $value->notify_via_twitter == 'on'  ){
      //   self::notifyViaTwitter($value);
      }

      if( $value->notify_via_email == 'on' ) {
      //  self::notifyViaEmail($value);
      }

      if( $value->notify_via_sms == 'on' ){
        self::notifyViaSms($value);
      }
    }
  }

  /**
   * Make notification on facebook
   *
   * @param  object $value
   * @return
   */
  private function notifyViaFacebook ($value) {
    if( $value->notify_via_facebook == 1 ){
      if($value->event_category_id == 1){
        $notification_message = "Hello UP Mindanao! You have an upcoming event!
        \n{$value->event} headed by {$value->org_name}.
        \nDescription: {$value->description}
        \nVenue: {$value->description}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
        \nPlease be guided accordingly. Thank You!";
      }

      if($value->event_category_id == 2){
        $notification_message = "Hello {$value->org_name}! You have an upcoming event!
        \n{$value->event}
        \nDescription: {$value->description}
        \nVenue: {$value->description}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
        \nPlease be guided accordingly. Thank You!";
      }

      if($value->event_category_id == 3){
        $notification_message = "Hello Student Leaders! You have an upcoming event!
        \n{$value->event} headed by {$value->org_name}.
        \nDescription: {$value->description}
        \nVenue: {$value->description}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
        \nPlease be guided accordingly. Thank You!";
      }

      if($value->event_category_id == 4){
        $notification_message = "Hello {$value->fname}! Your {$value->event} event has been approved.
        \nDescription: {$value->description}
        \nVenue: {$value->description}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
        \nPlease be guided accordingly. Thank You!";
      }
      $data['fb_message'] = $notification_message;
      $result = User::send($data['fb_message']);
    }
  }

  private function notifyViaTwitter ($value) {
    if( $value->notify_via_twitter == 1  ){

      if($value->event_category_id == 1){
        $notification_message = "Hello UP Mindanao! You have an upcoming event! ".
        "{$value->event} headed by {$value->org_name}.".
        " Venue: {$value->description}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
      }

      if($value->event_category_id == 2){
        $notification_message = "Hello {$value->org_name}! You have an upcoming event! ".
        "{$value->event}".
        " Venue: {$value->description}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
      }

      if($value->event_category_id == 3){
        $notification_message = "Hello Student Leaders! You have an upcoming event!".
        "{$value->event} headed by {$value->org_name}".
        " Venue: {$value->description}".
        " Duration: {$value->date_start}, {$value->date_start_time}";
      }

      if($value->event_category_id == 4){
        $notification_message = "Hello {$value->fname}! Your {$value->event} event has been approved. ".
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
      if ($value->event_category_id == 1) {
        $notification_message =
          "Hello UP Mindanao! You have an upcoming event! " .
          "\n{$value->event} headed by {$value->org_name}." .
          "\nDescription: {$value->description}" .
          "\nVenue: {$value->description}" .
          "\nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time} " .
          "\nPlease be guided accordingly. Thank You!";

        // $all_users = User::all();
        $all_users = User::all()->take(2);
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
        $notification_message = "Hello {$value->org_name}! You have an upcoming event!
          \n{$value->event}
          \nDescription: {$value->description}
          \nVenue: {$value->description}
          \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
          \nPlease be guided accordingly. Thank You!";

          // Demo
          // $result =
          //   Nexmo::message()->send([
          //     'to'   => '639958633866',
          //     'from' => '639124918787',
          //     'text' => $notification_message
          //   ]);
        $org = OrganizationGroup::where('organization_id', '=', $value->organization_id)->get();
        $old = [];
        foreach ($org as $key => $value) {
          d(User::find($value->user_id)->mobile_number);

          // if ( ! isset($old[$value->user_id])) {
          //   $old[$value->user_id] = $value->user_id;
          //   if( $value->notify_via_sms == 1 ){
          //     $result =
          //         Nexmo::message()->send([
          //           'to'   => $value->mobile_number,
          //           'from' => '639124918787',
          //           'text' => $notification_message
          //       ]);
          //   }
          // }

        }
      }

      if($value->event_category_id == 3){
        $notification_message = "Hello Student Leaders! You have an upcoming event!
        \n{$value->event} headed by {$value->org_name}.
        \nDescription: {$value->description}
        \nVenue: {$value->description}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
        \nPlease be guided accordingly. Thank You!";
      }

      if($value->event_category_id == 4){
        $notification_message = "Hello {$value->fname}! Your {$value->event} event has been approved.
        \nDescription: {$value->description}
        \nVenue: {$value->description}
        \nDuration: {$value->date_start}, {$value->date_start_time} to {$value->date_end}, {$value->date_end_time}
        \nPlease be guided accordingly. Thank You!";
      }


    }
  }
}
