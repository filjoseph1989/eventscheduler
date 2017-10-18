<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RandomHelper;

# Traits
use App\Common\ValidationTrait;
use App\Common\CommonMethodTrait;

use Auth;

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
 * @date 10-14-2017 - updated
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

    private $theme = 'theme-teal';

    /**
     * Build instance of a class
     */
    public function __construct()
    {
    }

    /**
     * Display a list of event need to be approve
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RandomHelper $helper)
    {
    
      $events = Event::with('organization')
        ->where('event_type_id', 1)
        ->where('is_approve', 'false')
        ->where('status', 'requested')
        ->get();

      return view('approve-events')->with([
        'events'     => $events,
        'helper'     => $helper
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
      $this->validateRequest($this, $request);

      $org_id = OrganizationGroup::where('user_id', Auth::id())
        ->where('position_id', 3)
        ->get();

      if ($request->category == "university" || $request->category == "organization") {
        $event_type_id = 1;
      } elseif ($request->category == "within" || $request->category == "personal") {
        $event_type_id = 2;
      }
      
      if( $request->category != "personal" ) {
        $event = Event::with('organization')
          ->create(
          [
            "user_id"         => $request->user_id,
            "organization_id" => $org_id[0]->organization_id,
            "event_type_id"   => $event_type_id,
            "semester_id"     => $request->semester_id,
            "category"        => $request->category,
            "title"           => $request->title,
            "description"     => $request->description,
            "venue"           => $request->venue,
            "date_start"      => date('Y-m-d', strtotime($request->date_start)),
            "date_end"        => date('Y-m-d', strtotime($request->date_end)),
            "date_start_time" => date('H:i:s', strtotime($request->date_start_time)),
            "date_end_time"   => date('H:i:s', strtotime($request->date_end_time)),
            "whole_day"       => ($request->whole_day == "1") ? 'true': 'false',
          ]
        );
      } else {
          $event = PersonalEvent::with('organization')
            ->create(
          [
            "user_id"         => $request->user_id,
            "event_type_id"   => $event_type_id,
            "semester_id"     => $request->semester_id,
            "category"        => $request->category,
            "title"           => $request->title,
            "description"     => $request->description,
            "venue"           => $request->venue,
            "date_start"      => date('Y-m-d', strtotime($request->date_start)),
            "date_end"        => date('Y-m-d', strtotime($request->date_end)),
            "date_start_time" => date('H:i:s', strtotime($request->date_start_time)),
            "date_end_time"   => date('H:i:s', strtotime($request->date_end_time)),
            "whole_day"       => ($request->whole_day == "1") ? 'true': 'false',
          ]
        );
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
      //   foreach ($value as $key => $event) {
      //     d($event);
      //   }
      // }
      // exit;

      // d($events, parent::isOrgMember(), parent::isOrgHead(), $id); exit;
      self::getDateComparison($events);
      // foreach ($events as $key => $value) {
        // d($value);
      // }
      // exit;
      
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
      $event = Event::with('organization')
        ->find($id);

      $event->facebook_msg = $request->facebook_msg;
      $event->twitter_msg  = $request->twitter_msg;
      $event->email_msg    = $request->email_msg;
      $event->sms_msg      = $request->sms_msg;

      if ($event->save()) {
        $result = ['result' => 'true'];
      } else {
        $result = ['result' => 'false'];
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
        //
    } 

    /**
     * Return array of events
     *
     * @param mixed $id
     * @return void
     */
    private function getEvents($kind, $userType)
    {
      /* Personal events are not included in this filtering */
      //I assigned all Events to $events to have a uniform array data-type except for the LOCAL EVENTS 
        if ($userType == 'org-head') {
          $events[] = Event::with('organization')
            ->where('category', '=', 'within')
            ->where('organization_id', self::getOrganizationLeading())
            ->get();
            return $events;
        }
        if ($userType == 'osa') {
          $events[] = Event::with('organization')
            ->where('category', 'organization')
            ->orWhere('category', 'university')
            ->get();
            return $events;
        }
        if ($userType == 'member') {
          if( self::getOrganizationLeading() == null) {
            //if org-user is not an org-adviser 
            $org_ids = self::getOrganizations();
            foreach ($org_ids as $key => $value) {
              $events[ $value ] =  Event::with('organization')
                ->where('category', 'within')
                ->where('organization_id', $value)
                ->get();
            }
            return $events;
          } else {
            //if the org-user is an org-adviser 
            $events[] = Event::with('organization')
              ->where('category', '=', 'within')
              ->where('organization_id', self::getOrganizationLeading())
              ->get();
            return $events;
          }
        }
      # return approve | disapprove events
      if ($kind == 'true' or $kind == 'false') {
        if ($userType == 'org-head') {
          $events[] = Event::with('organization')
          ->where('category', '=', 'within')
          ->where('organization_id', self::getOrganizations())
          ->where('is_approve', $kind)
          ->get();
          return $events;
        }
      }

      # Return All official or local event
      # within University or organization category
      if ($kind == 1) {
        $events[] = Event::with('organization')
        ->where('event_type_id', $kind)
        ->Where('category', 'university')
        ->get();
      }
      return $events;

      if ($kind == 2) {
        $org_id = OrganizationGroup::where('user_id', Auth::id() )
          ->get();
        
        $localEv = [];
        foreach ($org_id as $key => $value) {
          $localEv['within'][$value->id] = Event::with('organization')
            ->where('organization_id', $value->organization_id)
            ->where('event_type_id', $kind)
            ->where('category', 'within')
            ->get()
            ->toArray();
        }
        
        $localEv['personal'] = PersonalEvent::with('organization')
          ->where('event_type_id', $kind)
          ->where('user_id', Auth::id() )
          ->where('category', 'personal')
          ->get()
          ->toArray();

        return $localEv;
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
          foreach ($event as $key => $value) {
            if (self::matchDate($value->date_start)) {
              $event[$key]->status = "on going";
              # Issue 25
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
}
