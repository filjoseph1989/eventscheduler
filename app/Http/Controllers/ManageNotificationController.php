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
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function showNotificationPage()
  {
    return view('pages.users.organization-head.notifications.notification');
  }

  public function showEventList () {
    // $events = Event::where('user_id', Auth::user()->id )->get();
    $events_and_author = self::getEventsData();

    return view('pages.users.organization-head.notifications.notification', $events_and_author );
  }

  private function getEventsData(){
    $event = new Event();
    $events = $event->select(
        'events.id',
        'events.event',
        'event_types.name as event_type_name',
        'event_categories.name as event_category_name',
        'organizations.name as organization_name',
        'users.first_name as fname',
        'users.middle_name as mname',
        'users.last_name as lname',
        'users.suffix_name as sname',
        'events.date_start',
        'events.date_end',
        'events.date_start_time',
        'events.date_end_time',
        'events.venue',
        'events.status',
        'events.created_at',
        'events.updated_at'
      )
      ->join('event_types', 'event_types.id', '=', 'events.event_type_id')
      ->join('event_categories', 'event_categories.id', '=', 'events.event_category_id')
      ->join('organizations', 'organizations.id', '=', 'events.organization_id')
      ->join('users', 'users.id', '=', 'events.user_id')
      ->where('events.user_id', '=', Auth::user()->id)
      ->get();
      $current_user = User::find(Auth::user()->id);
      $event_author = "{$current_user->first_name} {$current_user->middle_name} {$current_user->last_name} {$current_user->suffix_name}";

    return ['events'=> $events, 'event_author'=> $event_author];
  }

  /**
   * This method will send notification on different media
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
      'events.event',
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

      if( $value->notify_via_facebook == 1 ){
        self::notifyViaFacebook($value);
      }

      if( $value->notify_via_twitter == 1  ){
        self::notifyViaTwitter($value);
      }

      if( $value->notify_via_email == 1 ) {
        self::notifyViaEmail($value);
      }

      if( $value->notify_via_sms == 1 ){
        self::notifyViaSms($value);
      }
    }
  }

  private function notifyViaSms ($value){

    if( $value->notify_via_sms == 1 ) {
      //where event_category == public view
      if($value->event_category_id == 1){
          $notification_message = "Hello UP Mindanao! You have an upcoming event!
          \n{$value->event} headed by {$value->org_name}.
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
          $all_users = User::all();
          $old = [];
          foreach ($all_users as $key => $value) {
            d($value->mobile_number);

            // if( $value->notify_via_sms == 1 ){
            //   $result =
            //     Nexmo::message()->send([
            //       'to'   => $value->mobile_number,
            //       'from' => '639124918787',
            //       'text' => $notification_message
            //   ]);
            // }
          }
        }
        // exit();
      }

      if($value->event_category_id == 2){
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
          dd($org);
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
        exit();
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

  /**
   * Send emails for notification
   *
   * @param  object $value
   * @return
   */
  private function notifyViaEmail ($value) {
    // Demo
    // Mail::to('janicalizdeguzman@gmail.com')->send(new Mailtrap());
    $org = OrganizationGroup::where('organization_id', '=', $value->organization_id)->get();

    $old = [];
    foreach ($org as $key => $value) {
      // d(User::find($value->user_id)->email);
      if ( ! isset($old[$value->user_id])) {
        $old[$value->user_id] = $value->user_id;
        if( $value->notify_via_email == 1 ){
          Mail::to(User::find($value->user_id)->email)->send(new Mailtrap());
        }
      }
    }

  }

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
}
