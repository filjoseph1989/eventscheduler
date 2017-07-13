<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Event;
use App\Mail\Mailtrap;
use App\Models\EventType;
use App\Models\Organization;
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
  public function notify(Request $data){
    if( isset($data['facebook']) ){
      self::notifyViaFacebook($data);
    }

     if( isset($data['twitter']) ){
       self::notifyViaTwitter($data);
     }
     if( isset($data['email']) ){
       self::notifyViaEmail($data);
     }
     if( isset($data['sms']) ){
       self::notifyViaSms($data);
     }

  }

  private function notifyViaSms (Request $data){
      // $message = "The event ".$events->name."  is on ".$events->date.", ".$events->time." at the ".$events->venue.".";
    if( isset($data['sms']) ){
      $result =
        Nexmo::message()->send([
          'to'   => '639958633866',
          'from' => '639124918787',
          'text' => 'Your event has been approved oimlmkmjnjnkjbkjblbjklk;.'
        ]);
    }
  }

  private function notifyViaEmail (Request $data) {
    if( isset($data['email']) ){
      Mail::to('janicalizdeguzman@gmail.com')->send(new Mailtrap());
    }
  }

  private function notifyViaFacebook (Request $data) {
    if( isset($data['facebook']) ){
      $result = User::send($data['fb_message']);
      // $result = User::send("This is a test message");
      echo "Good Job, you poster on facebook!! yeeeeey";
    }
  }

  private function notifyViaTwitter (Request $data) {
      // $message = "The event ".$events->name."  is on ".$events->date.", ".$events->time." at the ".$events->venue.".";
    if( isset($data['twitter']) ){
      return Twitter::postTweet(['status' => 'hi Event Schedulerscacassacijnkknjhhjkjbk', 'format' => 'json']);
    }
  }
}
