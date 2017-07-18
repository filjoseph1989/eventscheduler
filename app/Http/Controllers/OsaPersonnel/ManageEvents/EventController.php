<?php

namespace App\Http\Controllers\OsaPersonnel\ManageEvents;

use Auth;
use App\Models\Event;
use App\Models\Calendar;
use App\Models\EventType;
use App\Models\EventCategory;
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

  /**
   * Receive passed data and create new event
   *
   * @return json
   */
  public function createNewEvent(Request $data)
  {
    parent::loginCheck();

    if (parent::isOrgOsa()) {
      $request = $data->only(
        'user_id',
        'event_type_id',
        'event_category_id',
        'organization_id',
        'calendar_id',
        'event',
        'description',
        'venue',
        'date_start',
        'date_start_time',
        'date_end',
        'date_end_time',
        'whole_day'
      );

      # Set additional fields if the following is on
      $request['notify_via_facebook'] = ($data->facebook == 'on') ? 1 : null;
      $request['notify_via_twitter']  = ($data->twitter  == 'on') ? 1 : null;
      $request['notify_via_email']    = ($data->email    == 'on') ? 1 : null;
      $request['notify_via_sms']      = ($data->phone    == 'on') ? 1 : null;

      # Set default value for organization ID to 1 if not given
      $request['organization_id'] = ($data->only('organization_id')['organization_id'] == null) ? 1 : $data->only('organization_id')['organization_id'];

      # Finally create events
      $result = Event::create($request);

      if ($result->wasRecentlyCreated) {
        return redirect()->route('osa-personnel.event.get')
          ->with('status', 'Successfuly added new event');
      }
    } else {
      return redirect()->route('home');
    }
  }

  /**
   * ! Deprecated method
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
    parent::loginCheck();

    if (parent::isOrgOsa()) {
      $event      = Event::whereRaw('year(date_start) = year(now())')->get();
      $calendar   = Calendar::all();
      $login_type = 'user';

      # Sent to browser
      return view(
        'pages.users.osa-user.events.list',
        compact(
          'login_type',
          'event',
          'calendar'
        )
      );
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
}
