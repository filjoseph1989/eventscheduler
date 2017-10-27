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
use App\Models\Semester;
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
 * @date 10-20-2017 - updated
 */
class EventController extends Controller
{
    use ValidationTrait, CommonMethodTrait;

    private $list  = [
      'all',
      'official',
      'local',
      'true'  => 'Approved Events',
      'false' => 'Unapproved Events'
    ];

    private $date_start;
    private $date_end;
    private $time_start;
    private $time_end;

    private $theme = 'theme-teal';

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
        'helper' => $helper
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      # view
      return  view('events-add')->with([
        'semesters' => Semester::all()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // d($request); exit;
      $this->validateRequest($this, $request);

      $orgId = null;
      if(Auth::user()->user_type_id != 3) {
        $org_id = OrganizationGroup::where('user_id', Auth::id())
        ->where('position_id', 3)
        ->get();
        $orgId = $org_id[0]->organization_id;
      }

      if ($request->category == "university" || $request->category == "organization") {
        $event_type_id = 1;
        if(Auth::user()->user_type_id == 3) { 
          //if osa  user, is_approve is always true
          $is_approve = true;
        } 
        //if not osa, is_approve is default which is false because it needs approval from the osa all the time
      } else { # if doesnt satisfy above, event type automatically 2
        $event_type_id = 2;
          $is_approve = true;
          //always true for local events no matter what type of user_type_id because it's local events, doesn't need approval to advertise consent of the osa
      }

      

      $this->date_start = date('Y-m-d', strtotime($request->date_start));
      $this->date_end   = date('Y-m-d', strtotime($request->date_end));
      $this->time_start = date('H:i:s', strtotime($request->date_start_time));
      $this->time_end   = date('H:i:s', strtotime($request->date_end_time));

      $data = [
        "user_id"         => $request->user_id,
        "event_type_id"   => $event_type_id,
        "organization_id" => $orgId,
        "semester_id"     => $request->semester_id,
        "category"        => $request->category,
        "title"           => $request->title,
        "description"     => $request->description,
        "venue"           => $request->venue,
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
        $event = Event::create($data);
      }

      if ($event->wasRecentlyCreated) {
        return back()
          ->with('status', 'Successfully created new event');
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
      $events = self::whosGettingTheEvents($id);
      // foreach ($events as $key => $value) {
      //   if( $value->organization != null )
      //   d($value->organization->first()->name);
      // }
      // exit;

      self::getDateComparison($events);

      return view('events-list')
        ->with([
          'title'      => $this->list[$id],
          'events'     => $events,
          'eventType'  => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return Event::with('organization')
        ->where('id', $id)->get();
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
      $event = Event::find($id);

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
      if ($request->has('twitter_msg')) {
        $event->twitter_msg = $request->twitter_msg;
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

      echo json_encode($result);
    }

    /**
     * Display the local events
     *
     * @param  int $id
     * @param  RandomHelper $helper
     * @return \Illuminate\Response
     */
    public function dlv($id, RandomHelper $helper)
    {
      if ($id == 2) {
        $org_id = OrganizationGroup::where('user_id', Auth::id())
        ->get();

        $events = [];

        if( $org_id->isEmpty() ){
          $events['within'] = [];
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
        return view('local_events')
          ->with([
            'events' => $events,
            'helper' => $helper
          ]);
      }
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
     * This method compare the given date to current date
     * and when true, set the status to on going
     *
     * @return void
     */
    private function getDateComparison(&$events)
    {
      if ( ! is_null($events) ) {
        foreach ($events as $key => $event) {
          if ($events->count() > 1) {
            if (self::matchDate($event->date_start)) {
              $events[$key]->status = "on going";
              # Issue 25
            }
          } else {
            if (self::matchDate($event->date_start)) {
              $events[0]->status = "on going";
            }
          }
        }
      }
    }

    /**
     * Match the current month with the given month
     *
     * Issue 29
     *
     * @param int $date
     * @return void
     */
    private function matchDate($date)
    {
      list($year, $month, $day) = explode('-', $date);

      if (self::matchYear($year) and self::matchMonth($month) and self::matchDay($day)) {
        return true;
      }
      return false;
    }

    /**
     * Match the current year with the given year
     *
     * Issue 29
     *
     * @param int $year
     * @return void
     */
    private function matchYear($year)
    {
      if (date('Y') ==  $year){
        return true;
      }
      return false;
    }

    /**
     * Match the given month with the current month
     *
     * Issue 29
     *
     * @param int $month
     * @return void
     */
    private function matchMonth($month)
    {
      if (date('m') ==  $month){
        return true;
      }
      return false;
    }

    /**
     * Match the given day with current day
     *
     * Issue 29
     *
     * @param int $day
     * @return void
     */
    private function matchDay($day)
    {
      if (date('d') ==  $day){
        return true;
      }
      return false;
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

    /**
     * shows organization's official events
     */
    public function showOrgEvents($kind, $orgId)
    {

      $events = Event::where('organization_id', $orgId)
        ->where('event_type_id', $kind)
        ->where('is_approve', true)
        ->get();
    
      self::getDateComparison($events);

      return view('events-list')
        ->with([
          'title'      => $this->list[$kind],
          'events'     => $events,
          'eventType'  => $kind
        ]);
    }
}
