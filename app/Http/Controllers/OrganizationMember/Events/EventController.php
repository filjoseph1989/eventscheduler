<?php

namespace app\Http\Controllers\OrganizationMember\Events;

use Auth;
use App\Models\Event;
use App\Models\Calendar;
use App\Models\EventType;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\PersonalEvent;
use App\Models\OrganizationGroup;
use App\Http\Controllers\Controller;

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
   * Display the event
   *
   * @return
   */
  public function showEvents()
  {
    # Get the user organization ID
    $organization = OrganizationGroup::where('user_id', '=', Auth::user()->id)
      ->take(1)
      ->get();

    foreach ($organization as $key => $value) {
      $id = $value->organization_id;
    }

    # Get the events from organiation ID
    $event      = Event::where('organization_id', '=', $id)->get();
    $login_type = 'user';

    return view(
      'pages.users.organization-head.calendars.events.list_for_attendance',
      compact('event', 'login_type')
    );
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
      return redirect()->route('org-head.event.get')
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
    if (! Auth::check()) {
      return redirect()->route('login');
    }

    if (parent::isOrgMember()) {
      $event = Event::whereRaw('year(date_start) = year(now())')
        ->whereRaw("organization_id = ". $data->id)
        ->get();
    } else {
      $event = null;
    }

    echo json_encode( $event );
  }

  /**
   * Return the list of event within a year
   * @return
   */
  public function getEventOfTheMonthList()
  {
    if (! Auth::check()) {
      return redirect()->route('login');
    }

    if (parent::isOrgMember()) {
      $event = Event::whereRaw('year(date_start) = year(now())')->get();

      $login_type = 'user';
      $calendar   = Calendar::all();
      return view('pages.users.organization-head.calendars.events.list', compact('login_type', 'event', 'calendar'));
    } else {
      return redirect()->route('home');
    }
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

  /**
   * Return response to request of getting personal events
   * @param  Request $data
   * @return json
   */
  public function getPersonalEvent(Request $data)
  {
    # get the event from personal event table
    $event = PersonalEvent::where('user_id', '=', 1)
      ->get();

    # Load the relationship
    $event->load('eventCategory')
      ->load('eventType')
      ->load('user');

    # Send back to ajax
    echo json_encode([
      'event' => $event
    ]);
  }

  /**
   * Edit the event
   *
   * @param  Request $data
   * @return
   */
  public function editEvent(Request $data)
  {
    if (! Auth::check()) {
      return redirect()->route('login');
    }

    if (parent::isOrgMember()) {
      $request = $data->only([
        'user_id',
        'event_type_id',
        'event_category_id',
        'calendar_id',
        'organization_id',
        'event',
        'description',
        'venue',
        'date_start',
        'date_start_time',
        'date_end',
        'date_end_time',
        'whole_day'
        // 'facebook',
        // 'twitter',
        // 'email',
        // 'phone'
      ]);

      if ( $request['event_type_id'] == 0 ) unset($request['event_type_id']);
      if ( $request['event_category_id'] == 0 ) unset($request['event_category_id']);
      if ( $request['calendar_id'] == 0 ) unset($request['calendar_id']);
      if ( ! isset($request['organization_id']) || $request['organization_id'] == 0 ) unset($request['organization_id']);

      $event = Event::find($data->event_id);
      $name  = $event->event;
      $event = $event->update($request);
      if ($event) {
        return redirect()->route('org-head.event.get')
          ->with('status', "Successfully change from <strong>{$name}</strong> to <strong>{$request['event']}</strong>");
      }
    } else {
      return redirect()->route('org-head.event.get');
    }
  }
}