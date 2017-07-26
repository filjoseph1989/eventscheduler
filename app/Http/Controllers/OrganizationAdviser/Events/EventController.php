<?php

namespace app\Http\Controllers\OrganizationAdviser\Events;

use Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\EventType;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\PersonalEvent;
use App\Models\EventCategory;
use App\Models\OrganizationGroup;
use App\Models\OrganizationAdviserGroup;
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
   * @return Illuminate\Response
   */
  public function createNewEvent(Request $data)
  {
    # is the user login?
    parent::loginCheck();

    # is this user and adviser to an organization?
    self::thisAdviser($data->organization_id);

    # is the user an adviser?
    if (parent::isOrgAdviser()) {
      $request = $data->only(
        'user_id',
        'event_type_id',
        'event_category_id',
        'organization_id',
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
        return back()
        ->with('status', 'Successfuly added new event');
      }
    } else {
      return redirect()->route('home');
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
    # Is the user loggedin?
    parent::loginCheck();

    # Is the user an adviser?
    if (parent::isOrgAdviser()) {
      $login_type     = 'user';
      $event_type     = EventType::all();
      $event_category = EventCategory::all();
      $organization   = OrganizationAdviserGroup::with('organization')
        ->where('organization_adviser_groups.user_id', '=', Auth::user()->id)
        ->get();

      return view(
        'pages/users/organization-adviser/calendars/events/new_event',
        compact(
          'login_type',
          'event_type',
          'event_category',
          'organization'
        )
      );
    }
  }

  /**
   * Return form for creating personal event in
   * adviser account
   *
   * @return Illuminate\Response
   */
  public function createMyNewEventForm()
  {
    # Is the user loggedin?
    parent::loginCheck();

    # Is the user an adviser?
    if (parent::isOrgAdviser()) {
      $login_type     = 'user';
      $event_type     = EventType::all();
      $organization   = OrganizationAdviserGroup::with('organization')
        ->where('organization_adviser_groups.user_id', '=', Auth::user()->id)
        ->get();

      return view(
        'pages/users/organization-adviser/calendars/events/my_new_event',
        compact(
          'login_type',
          'event_type',
          'organization'
        )
      );
    }
  }

  /**
   * Store new event information to table personal_events
   *
   * @param  Request $data
   * @return Object
   */
  public function myNewEvent(Request $data)
  {
    $event = $data->only([
      "user_id",
      "title",
      "description",
      "venue",
      "date_start",
      "date_start_time",
      "date_end",
      "date_end_time",
      "whole_day",
      "event_type_id",
      "category",
      "semester"
      // "facebook",
      // "twitter",
      // "email",
      // "phone"
    ]);

    empty($event['date_end']) ? "0000-00-00" : $event['date_end'];
    empty($event['date_end_time']) ? "00:00" : $event['date_end_time'];

    $event = PersonalEvent::create($event);
    if ($event->wasRecentlyCreated) {
      return back()->with('status', 'Successfuly Saved');
    } else {
      return back()->with('status', "Sorry, there's a problem on saving");
    }
  }

  /**
   * Return the list of event type
   * @return
   */
  public function getEventType()
  {
    # is the user loggedin?
    parent::loginCheck();

    # is the user an adviser?
    if (parent::isOrgAdviser()) {
      $login_type     = 'user';
      $event_category = EventCategory::all();

      # Render table of event category
      return view(
        'pages/users/organization-adviser/calendars/events/category',
        compact(
          'login_type',
          'event_category'
        )
      );
    } else {
      return redirect()->route('home');
    }
  }

  /**
   * Return the list of event from the given event type
   *
   * @param  int $id Event Type ID
   * @return Illuminate\Response
   */
  public function getEventList($id = null)
  {
    # is the user loggedin?
    parent::loginCheck();

    # is the user an adviser?
    if (parent::isOrgAdviser()) {
      $login_type = 'user';
      $title      = 'My Advisory Organization Events';

      # type of calendar
      # Issue 35: This should be automatically determined by the system
      $calendar = Calendar::all();

      /*
        Get all events from the given category
       */
      $event = Event::with('EventType')
        ->with('organization')
        ->where('events.event_type_id', '=', $id)
        ->whereRaw('year(date_start) = year(now())')
        ->get();

      return view(
        'pages/users/organization-adviser/calendars/events/list',
        compact(
          'login_type',
          'event',
          'calendar',
          'title'
        )
      );
    } else {
      return redirect()->route('home');
    }
  }

  /*
    Evaluate below if what method is still in use
   */

  /**
   * Display events
   *
   * @return void
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
    parent::loginCheck();

    if (parent::isOrgAdviser()) {
      $event = Event::whereRaw('year(date_start) = year(now())')
      ->whereRaw("organization_id = ". $data->id)
      ->get();

      echo json_encode( $event );
    }
  }

  public function getEventListPublic()
  {
    parent::loginCheck();

    if (parent::isOrgAdviser()) {
      $login_type = 'user';
      $title      = 'Public Events';

      # type of calendar
      # Issue 35: This should be automatically determined by the system
      $calendar = Calendar::all();

      # Get all events where this account is an adviser
      $event = Event::select(
        '*',
        'organizations.id as org_id',
        'organizations.name as org_name'
      )
      ->join('organization_adviser_groups', 'organization_adviser_groups.organization_id', '=', 'events.organization_id')
      ->join('organizations', 'organizations.id', '=', 'events.organization_id')
      ->where('organization_adviser_groups.user_id', '=', Auth::user()->id)
      ->where('events.event_category_id', '=', 1)
      ->whereRaw('year(date_start) = year(now())')
      ->get();

      return view(
        'pages/users/organization-adviser/calendars/events/list',
        compact(
          'login_type',
          'event',
          'calendar',
          'title'
        )
      );
    } else {
      return redirect()->route('home');
    }
  }

  public function getEventListWithin()
  {
    parent::loginCheck();

    if (parent::isOrgAdviser()) {
      $login_type = 'user';
      $title      = 'Events within organization';

      # type of calendar
      # Issue 35: This should be automatically determined by the system
      $calendar = Calendar::all();

      # Get all events where this account is an adviser
      $event = Event::select(
        '*',
        'organizations.id as org_id',
        'organizations.name as org_name'
      )
      ->join('organization_adviser_groups', 'organization_adviser_groups.organization_id', '=', 'events.organization_id')
      ->join('organizations', 'organizations.id', '=', 'events.organization_id')
      ->where('organization_adviser_groups.user_id', '=', Auth::user()->id)
      ->where('events.event_category_id', '=', 1)
      ->whereRaw('year(date_start) = year(now())')
      ->get();

      return view(
        'pages/users/organization-adviser/calendars/events/list',
        compact(
          'login_type',
          'event',
          'calendar',
          'title'
        )
      );
    } else {
      return redirect()->route('home');
    }
  }

  public function getEventListAmong()
  {
    parent::loginCheck();

    if (parent::isOrgAdviser()) {
      $login_type = 'user';
      $title      = 'Organizations Events';

      # type of calendar
      # Issue 35: This should be automatically determined by the system
      $calendar = Calendar::all();

      # Get all events where this account is an adviser
      $event = Event::select(
        '*',
        'organizations.id as org_id',
        'organizations.name as org_name'
      )
      ->join('organization_adviser_groups', 'organization_adviser_groups.organization_id', '=', 'events.organization_id')
      ->join('organizations', 'organizations.id', '=', 'events.organization_id')
      ->where('organization_adviser_groups.user_id', '=', Auth::user()->id)
      ->where('events.event_category_id', '=', 1)
      ->whereRaw('year(date_start) = year(now())')
      ->get();

      return view(
        'pages/users/organization-adviser/calendars/events/list',
        compact(
          'login_type',
          'event',
          'calendar',
          'title'
        )
      );
    } else {
      return redirect()->route('home');
    }
  }

  public function getEventListOwn()
  {
    parent::loginCheck();

    if (parent::isOrgAdviser()) {
      $login_type = 'user';
      $title      = 'My Personal Events';

      # type of calendar
      # Issue 35: This should be automatically determined by the system
      $calendar = Calendar::all();

      # Get all events where this account is an adviser
      $event = Event::select(
        '*',
        'organizations.id as org_id',
        'organizations.name as org_name'
      )
      ->join('organization_adviser_groups', 'organization_adviser_groups.organization_id', '=', 'events.organization_id')
      ->join('organizations', 'organizations.id', '=', 'events.organization_id')
      ->where('organization_adviser_groups.user_id', '=', Auth::user()->id)
      ->where('events.event_category_id', '=', 1)
      ->whereRaw('year(date_start) = year(now())')
      ->get();

      return view(
        'pages/users/organization-adviser/calendars/events/list',
        compact(
          'login_type',
          'event',
          'calendar',
          'title'
        )
      );
    } else {
      return redirect()->route('home');
    }
  }

  /**
   * Get personal event of the month
   *
   * ! Deprecated method
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
   * return event stored in personal event table
   *
   * @param  Request $data
   * @return
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

  /**
   * return true if this account is an adviser to the
   * given organization ID
   *
   * @return
   */
  private function thisAdviser($id)
  {
    $adviser = OrganizationAdviserGroup::where('organization_id', '=', $id)->get();
  }
}
