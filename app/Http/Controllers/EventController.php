<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\EventType;
use App\Models\EventCategory;
use App\Models\Organization;
use Illuminate\Http\Request;

/**
 * Manage the events
 *
 * @author jlvoice777
 * @since 0.0.0
 * @version 0.2
 */
class EventController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('web');
  }

  /**
   * Receive passed data and create new event
   *
   * @return json
   */
  public function createNewEvent(Request $data)
  {
    $fromCalendar = isset($data->from_calendar) ? $data->from_calendar : null;

    # Reformat submitted date to mysql compatible format
    if (isset($data->form)) {
      $request = [];
      foreach ($data->form as $key => $value) {
        if (($value['name'] == 'date_start' or $value['name'] == 'date_end') and ! empty($value['value'])) {
          $request[$value['name']] = date( "Y/m/d", strtotime($value['value']));
        } else {
          $request[$value['name']] = $value['value'];
        }
      }
    } else {
      $request = $data->only(
        'user_id',
        'from_calendar',
        'event',
        'description',
        'venue',
        'date_start',
        'date_start_time',
        'date_end',
        'date_end_time',
        'whole_day',
        'event_type_id',
        'event_category_id',
        'organization_id',
        'calendar_id'
      );
    }

    # Update the table events
    $result = Event::create($request);

    # Make notification here after successfull insert of event
    if ($result->wasRecentlyCreated) {
      # Make notification here
      if ($data->facebook == 'on') {
        /*
          facebook notification here
         */
      }
      if ($data->twitter == 'on') {
        /*
          twitter notification here
         */
      }
      if ($data->email == 'on') {
        /*
          email notification here
         */
      }
      if ($data->phone == 'on') {
        /*
          phone notification here
         */
      }
    }

    if (isset($fromCalendar)) {
      return redirect()->route('event.get')
        ->with('status', 'Successfuly Added new event');
    } else {
      # This part here is used to reponse the ajax method of request

      # Format date for calendar display
      $request['date_start'] = str_replace('/', '-', $request['date_start']);
      $request['date_end']   = str_replace('/', '-', $request['date_end']);

      # Response to HTTP request (ajax)
      echo json_encode([
        'request'            => $request,
        'wasRecentlyCreated' => $result->wasRecentlyCreated
      ]);
    }
  }

  /**
   * Create new event as a response to event page
   *
   * @param  Request $data
   * @return \Response
   */
  public function createNewEventForm()
  {
    $login_type     = 'user';
    $calendar       = Calendar::all();
    $event_type     = EventType::all();
    $event_category = EventCategory::all();

    return view(
      'pages.users.organization-head.calendars.events.new_event',
      compact(
        'login_type',
        'calendar',
        'event_type',
        'event_category'
      )
    );
  }

  /**
   * Return the event for the current month
   *
   * @return
   */
  public function getEventOfTheMonth(Request $data)
  {
    $event = Event::whereRaw('year(date_start) = year(now())')
      ->whereRaw("organization_id = ". $data->id)
      ->get();

    echo json_encode( $event );
  }

  /**
   * Return the list of event within a year
   * @return
   */
  public function getEventOfTheMonthList()
  {
    $event = Event::whereRaw('year(date_start) = year(now())')->get();

    $login_type = 'user';
    $calendar   = Calendar::all();
    return view('pages.users.organization-head.calendars.events.list', compact('login_type', 'event', 'calendar'));
  }

  /**
   * Used to response the http request for a single event
   * information
   *
   * @return json
   */
  public function getEvent(Request $data)
  {
    $event = Event::find($data->id);
    $event->load('eventCategory');
    $event->load('eventType');
    $event->load('organization');
    $event->load('user');

    echo json_encode([
      'event' => $event
    ]);
  }
}
