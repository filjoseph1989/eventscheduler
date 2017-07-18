<?php

namespace app\Http\Controllers\OrganizationHead\Events;

use Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\EventType;
use App\Models\EventCategory;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\OrganizationGroup;
use App\Models\EventApprovalMonitor;
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

        if ($data->facebook == 'on') {
          $request['notify_via_facebook'] = 1;
        }
        if ($data->twitter == 'on') {
            $request['notify_via_twitter'] = 1;
        }
        if ($data->email == 'on') {
          $request['notify_via_email'] = 1;
        }
        if ($data->phone == 'on') {
          $request['notify_via_sms'] = 1;
        }
    }
    # Update the table events
    $result = Event::create($request);

    # Make notification here after successfull insert of event


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
   * Get personal event of the month
   * @return
   */
  public function getPersonalEventOfTheMonthList()
  {
    if (! Auth::check()) {
      return redirect()->route('login');
    }

    if (parent::isOrgHead()) {
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

    $event_monitor = new EventApprovalMonitor();
    $em = $event_monitor->select(
      'event_approval_monitors.event_id',
      'event_approval_monitors.approvers_id',
      'users.first_name as fname',
      'users.middle_name as mname',
      'users.last_name as lname',
      'users.suffix_name as sname'
    )
    ->join('users', 'event_approval_monitors.approvers_id', '=', 'users.id')
    ->where('event_approval_monitors.event_id', '=', $data->id)
    ->get();


    // $event_monitor = EventApprovalMonitor::with(['user','event'])
    // ->where('event_id', '=', $data->id)
    // ->get();

    echo json_encode([
      'event' => $event,
      'event_monitor' => $em
    ]);
  }

  /**
   * Approve events
   * @return
   */
  public function approveEvents()
  {
    # Check the authentication of this account
    parent::loginCheck();

    # Check if the account is an OSA
    if (parent::isOrgHead()) {
      # Check if the account is an approver
      if (parent::isApprover()) {
        $login_type = 'user';

        # Get all event that need the Org Head's approval
        # This method is declare below as private.
        $ev = self::getGetEventsNeedApproval();

        return view('pages.users.osa-user.events.approve-events', compact('login_type','ev'));
      }
    } else {
      return redirect()->route('home');
    }
  }

  /**
   * Return the list of events that the organization head's
   * approval
   *
   * @return
   */
  private function getGetEventsNeedApproval()
  {
    return Event::select(
      'events.*',
      'organizations.id as org_id',
      'organizations.name as org_name',
      'organization_groups.user_id as orgg_uid',
      'organizations.name as org_name',
      'users.first_name as fname'
    )
    ->join('organization_groups', 'events.organization_id', '=', 'organization_groups.organization_id')
    ->join('organizations', 'events.organization_id', '=', 'organizations.id')
    ->join('users', 'events.user_id', '=', 'users.id')
    ->where('approver_count', '<', 3)
    ->where('organization_groups.user_id', '=', Auth::user()->id)
    ->get();
  }
}
