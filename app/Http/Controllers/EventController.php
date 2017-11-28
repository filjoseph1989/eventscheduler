<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RandomHelper;

# Traits
use App\Common\ValidationTrait;
use App\Common\CommonMethodTrait;

use Auth;
use DateTime;

# Models
use App\Models\Event;
use App\Models\EventType;
use App\Models\EventGroup;
use App\Models\OrganizationGroup;
use App\Models\PersonalEvent;


/**
 * CRUDS class for events
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 2.1
 * @date 10-14-2017
 * @date 11-06-2017 - updated
 */
class EventController extends Controller
{
    use ValidationTrait, CommonMethodTrait;

    private $list  = [
      ' ',
      'official',
      'local',
      'true'  => 'Approved Events',
      'false' => 'Unapproved Events'
    ];

    /**
     * Date
     * @var int
     */
    private $date_start;
    private $date_end;
    private $time_start;
    private $time_end;

    # Issue 34
    private $theme = 'theme-teal';

    /**
     * User type
     * @var int
     */
    private $account = 0;

    /**
     * Returned events
     */
    private $events;

    /**
     * Validate exception
     * @var array
     */
    private $exception = [];

    /**
     * Build instance of a class
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a list of event need to be approve
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RandomHelper $helper)
    {
      $events = Event::getEventsForApproval(); # this is located in the event model

      return view('approve-events')->with([
        'events' => $events,
        'helper' => $helper,
        'account'    => self::getAccount(Auth::user()->user_type_id)
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('events-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validateRequest($this, $request);

      $orgId = null;

      if (! parent::isOsa() && ( $request->category == "university" || $request->category == "organization" || $request->category == "within" ) ) {
        $org_id = OrganizationGroup::where('user_id', Auth::id())
          ->where('position_id', 3)
          ->get();

        if ($org_id->count() >= 1) {
          $orgId = $org_id[0]->organization_id;
        } else {
          return back()
            ->with('status_warning', "You cannot create event, because currently you don't belong to any registered organization");
        }
      } else {
        $orgId = 1;
      }

      $is_approve = 'false';
      if ($request->category == "university" || $request->category == "organization") {
        $event_type_id = 1;
      } else {
        $event_type_id = 2;
      }

      $this->date_start = date('Y-m-d', strtotime($request->date_start));
      $this->date_end   = date('Y-m-d', strtotime($request->date_end));
      $this->time_start = date('H:i:s', strtotime($request->date_start_time));
      $this->time_end   = date('H:i:s', strtotime($request->date_end_time));

      $data = [
        "user_id"         => $request->user_id,
        "event_type_id"   => $event_type_id,
        "organization_id" => $orgId,
        "category"        => $request->category,
        "title"           => ucwords($request->title),
        "description"     => $request->description,
        "venue"           => ucwords($request->venue),
        "date_start"      => $this->date_start,
        "date_end"        => $this->date_end,
        "date_start_time" => $this->time_start,
        "date_end_time"   => $this->time_end,
        "whole_day"       => self::wholeDayOrNot(),
        "is_approve"      => $is_approve,
      ];

      if ($request->category == 'personal') {
        unset($data['organization_id']);
        $event = PersonalEvent::create($data);
      } else {
        if (parent::isOrgMember()) {
          return back()
            ->withInput()
            ->with('status_warning', 'You are not allowed to created official event');
        }
        $event = Event::create($data);
      }

        if( $request->category == 'personal' ){
          if( Auth::user()->user_type_id == 1){
            return back()
            ->with('status', 'Successfully saved your event to "Local" List Of Events');
          } else {
            return back()
            ->with('status', 'Successfully saved your event to "Personal" List Of Events');
          }
        } else if( $request->category == 'organization' || $request->category == 'university' ) {
            return back()
            ->with('status', 'Successfully saved your event to "Official" List Of Events');
        } else {
          return back()
            ->with('status', 'Successfully saved your event to "Local" List Of Events');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $this->account = Auth::user()->user_type_id;
      $this->events = self::whosGettingTheEvents($id);
      $ids = self::getOrganizationsID();

      self::getDateComparison($this->events);

      return view('events-list')
        ->with([
          'title'      => $this->list[$id], # title of the modal
          'events'     => $this->events,
          'eventType'  => $id,
          'account'    => self::getAccount(Auth::user()->user_type_id),
          'org_ids'    => $ids,
        ]);
    }

    /**
     * Response to the event information
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return Event::with('organization')
        ->with('user')
        ->with('eventType')
        ->where('id', $id)
        ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if ($request->has('type') AND $request->type == 'edit-event') {
        $this->validateRequest($this, $request);
        $json = true;
      }

      $event = Event::find($id);

      if ($request->has('title')) {
        $event->title = $request->title;
      }
      if ($request->has('description')) {
        $event->description = $request->description;
      }
      if ($request->has('venue')) {
        $event->venue = $request->venue;
      }
      if ($request->has('date_start')) {
        $event->date_start = $request->date_start;
      }
      if ($request->has('date_start_time')) {
        $event->date_start_time = $request->date_start_time;
      }
      if ($request->has('date_end')) {
        $event->date_end = $request->date_end;
      }
      if ($request->has('date_end_time')) {
        $event->date_end_time = $request->date_end_time;
      }
      if ($request->has('category')) {
        $event->category = $request->category;
      }
      if ($request->has('facebook')) {
        $event->facebook = ($request->facebook === true) ? 'off' : 'on';
      }
      if ($request->has('twitter')) {
        $event->twitter = ($request->twitter === true) ? 'off' : 'on';
      }
      if ($request->has('sms')) {
        $event->sms = ($request->sms === true) ? 'off' : 'on';
      }
      if ($request->has('email')) {
        $event->email = ($request->email === true) ? 'off' : 'on';
      }
      if ($request->has('facebook_msg')) {
        $event->facebook_msg = $request->facebook_msg;
      }
      if ($request->has('email_msg')) {
        $event->email_msg = $request->email_msg;
      }
      if ($request->has('sms_msg')) {
        $event->sms_msg = $request->sms_msg;
      }

      if ($event->save()) {
        $result['result'] = true;
      } else {
        $result['result'] = false;
      }

      if (isset($json) AND $json === true) {
        return back()
          ->with('status', 'Successfully updated');
      }

      echo json_encode($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $event = Event::where('id', $id)
        ->get();

      $event = $event[0];

      if ($event->user_id == Auth::id() AND $event->is_approve == 'false') {
        if ($event->delete()) {
          return back()
            ->with('status', 'Deleted the event');
        }
      } else {
        return back()
          ->with('status_warning', "Sorry, you're not allowed to delete this event");
      }
    }

    /**
     * Display the local events
     *
     * @param  int $id
     * @param  RandomHelper $helper
     * @return \Illuminate\Response
     */
    public function personaEvent($id, RandomHelper $helper)
    {
      if ($id == 2) {
        $org_id = OrganizationGroup::where('user_id', Auth::id())
          ->get();

        $events = [];

        if( $org_id->isEmpty() ){
          $events['within']   = [];
          $events['personal'] = PersonalEvent::where('event_type_id', $id)
            ->where('user_id', Auth::id())
            ->where('category', 'personal')
            ->get()
            ->toArray();
        }

        foreach ($org_id as $key => $value) {
          $events['within'][$value->id] = Event::with('organization')
            ->where('organization_id', $value->organization_id)
            ->where('event_type_id', $id)
            ->where('category', 'within')
            ->get()
            ->toArray();
        }

        $events['personal'] = PersonalEvent::where('event_type_id', $id)
          ->where('user_id', Auth::id())
          ->where('category', 'personal')
          ->get()
          ->toArray();

          $this->account = Auth::user()->user_type_id;

        return view('local_events')
          ->with([
            'eventsPersonal' => $events['personal'],
            'eventsWithin'   => $events['within'],
            'helper'         => $helper,
            'eventType'      => $id,
            'account'        => self::getAccount(Auth::user()->user_type_id)
          ]);
      }
    }

    /**
     * Display the list of event, depending on the requested type
     *
     * @param  int $kind
     * @param  int $orgId
     * @return Illuminate\Response
     */
    public function showOrgEvents($kind, $orgId)
    {
      $events = Event::where('organization_id', $orgId)
        ->where('event_type_id', $kind)
        ->get();

      self::getDateComparison($events);

      return view('events-list')
        ->with([
          'title'     => $this->list[$kind],
          'events'    => $events,
          'eventType' => $kind,
          'account'   => self::getAccount(Auth::user()->user_type_id)
        ]);
    }

    /**
     * Display the list of event conflicts
     *
     * @return \Illuminate\Response
     */
    public function showListOfEventConflict()
    {
      $results = Event::whereIn('date_start', function ( $query ) {
        $query
          ->select('date_start')
          ->from('events')
          ->groupBy('date_start')
          ->havingRaw('count(*) > 1');
      })
      ->orderBy('date_start', 'asc')
      ->get();

      return view('events-conflict')
        ->with([
          'events' => $results
        ]);
    }

    /**
     * Return array of events
     *
     * @param mixed $id
     * @return void
     */
    private function getEvents($kind, $userType)
    {
      # All event for org head
      if ($kind == '0' and $userType == 'org-head') {
        return Event::getOrgHeadEvents(self::leaderID());
      }

      # All event for osa
      if ($kind == '0' and $userType == 'osa') {
        return Event::getOsaEvents();
      }

      # All event for member
      if ($kind == '0' and $userType == 'member') {
        # If org-user is not an org-adviser
        if (is_null(self::leaderID())) {
          $IDs = self::getOrganizationsID();

          # Get Events
          $events = [];
          foreach ($IDs as $key => $id) {
            $events[$id] = Event::getMemberEvents($id);
          }

          return $events;
        }

        # if the org-user is an org-adviser
        return Event::getOrgHeadEvents(self::leaderID());
      }

      # return approve | disapprove events for organization head
      if (($kind == 'true' or $kind == 'false') and $userType == 'org-head') {
        return Event::getOrgHeadApprovedEvents(self::getOrganizationsID(), $kind);
      }

      # return approve | disapprove events for osa
      if (($kind == 'true' or $kind == 'false') and $userType == 'osa') {
        return Event::getApproveOrUnapproveEvents($kind);
      }

      # Return All official
      if ($kind == 1) {
        return Event::getOfficialEvents($kind);
      }
    }

    /**
     * Determine what account is looking to display all the
     * events
     *
     * @return
     */
    private function whosGettingTheEvents($id)
    {
      if (parent::isOrgHead()) {
        return self::getEvents($id, 'org-head');
      }

      if (parent::isOsa()) {
        return self::getEvents($id, 'osa');
      }

      if (parent::isOrgMember()) {
        return self::getEvents($id, 'member');
      }
    }

    /**
     * Determine if the given must be a whole day event or
     * not
     *
     * @return boolean
     */
    private function wholeDayOrNot()
    {
      list($year1, $month1, $day1) = explode('-', $this->date_start);
      list($year2, $month2, $day2) = explode('-', $this->date_end);
      list($hr1, $sec1, $milisec1) = explode(':', $this->time_start);
      list($hr2, $sec2, $milisec2) = explode(':', $this->time_end);

      if (self::matchDates( $year1, $year2, $month1, $month2, $day1, $day2)) {
        if (self::matchTimes($hr1, $sec1, $milisec1, $hr2, $sec2, $milisec2)) {
          return 'false';
        } else {
          if (self::twelveHoursOrMore($this->time_start, $this->time_end)) {
            return 'true';
          } else {
            return 'false';
          }
        }
      } else {
        return 'true';
      }
    }

    /**
     * Use to compare time
     *
     * @param  int $ye1
     * @param  int $ye2
     * @param  int $mon1
     * @param  int $mon2
     * @param  int $d1
     * @param  int $d2
     * @return boolean
     */
    private function matchDates($ye1, $ye2, $mon1, $mon2, $d1, $d2)
    {
      if (($ye1 == $ye2) && ($mon1 == $mon2) && ($d1 == $d2)) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Used to compare time
     *
     * @param  int $h1
     * @param  int $se1
     * @param  int $milise1
     * @param  int $h2
     * @param  int $se2
     * @param  int $milise2
     * @return int boolean
     */
    private function matchTimes($h1, $se1, $milise1, $h2, $se2, $milise2)
    {
      if (($h1 == $h2) && ($se1 == $se2) && ($milise1 == $milise2)) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Check if the time is within the range of
     * 12 hours
     *
     * @param  int $time1
     * @param  int $time2
     * @return int boolean
     */
    private function twelveHoursOrMore($time1, $time2)
    {
      $startTime = strtotime($time1);
      $endTime   = strtotime($time2);
      $duration = gmdate("H:i:s", ($endTime-$startTime));
      list($hr, $sec, $milisec) = explode(':', $duration);

      if (($hr >= 12) && ($sec >= 0) && ($milisec >= 0)) {
        return true;
      } else {
        return false;
      }
    }
}
