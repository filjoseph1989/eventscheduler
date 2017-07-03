<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventType;
use App\Models\EventCategory;
use App\Models\Organization;
use App\Models\User;
use Auth;

class ManageNotification extends Controller
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
    $event = new Event();
    $events = $event
    ->select(
      'events.id',
      'events.name',
      'event_types.name as event_type_name',
      'event_categories.name as event_category_name',
      'organizations.name as organization_name',
      'events.date',
      'events.time',
      'events.venue',
      'events.status',
      'events.created_at',
      'events.updated_at')
        ->join('event_types', 'event_types.id', '=', 'events.event_type_id')
        ->join('event_categories', 'event_categories.id', '=', 'events.event_category_id')
        ->join('organizations', 'organizations.id', '=', 'events.organization_id')
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', Auth::user()->id)
        ->get();

    return view('pages.users.organization-head.notifications.notification', compact('events') );
  }

  public function notify(Request $data){
    if( isset($data['facebook']) ){

    }
    if( isset($data['twitter']) ){

    }
    if( isset($data['instagram']) ){

    }
    if( isset($data['email']) ){
      
    }
    if( isset($data['sms']) ){
      $result =
        Nexmo::message()->send([
          'to' => '639958633866',
          'from' => '639124918787',
          'text' => 'Your event has been approved.'
        ]);
      dd($result);
    }
  }

}
