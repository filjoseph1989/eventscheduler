<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\ValidationTrait;
use App\Helpers\RandomHelper;

use Auth;

# Models
use App\Models\Event;
use App\Models\Semester;
use App\Models\EventType;
use App\Models\EventGroup;
use App\Models\OrganizationGroup;

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
    use ValidationTrait;

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
      $events = Event::where('event_type_id', 1)
        ->where('is_approve', 'false')
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
        'eventTypes' => EventType::all(),
        'semesters'  => Semester::all()
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

      $event = Event::create(
        [
          "event_type_id"   => $request->event_type_id,
          "semester_id"     => $request->semester_id,
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
      return Event::where('id', $id)->get();
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
      if ($kind == '0') {
        if ($userType == 'org-head') {
          return Event::where('category', '=', 'within')
            ->where('organization_id', self::getOrganization())
            ->get();
        }
        if ($userType == 'osa') {
          return Event::where('category', 'organizatio')
            ->orWhere('category', 'university')
            ->get();
        }
      }

      # return approve | disapprove events
      if ($kind == 'true' or $kind == 'false') {
        if ($userType == 'org-head') {
          return Event::where('category', '=', 'within')
            ->where('organization_id', self::getOrganization())
            ->where('is_approve', $kind)
            ->get();
        }
      }
      # Return All event within University or organization category
      // if ($id == '0') {
        # scene 1: OSA
        # scene 2: ORg head
          # check the  account if organization head's account
          # get the organization head organization from the table organization group
          # get the event base on the organization of the organization head

        # scene 3: Org MEmber

      //   return Event::where('category', 'university')
      //     ->orWhere('category', 'organization')
      //     ->get();
      // }

      # Return All approve or disapprove event
      # within University or organization category
      // if ($id == 'true' or $id == 'false') {
      //   return Event::where('is_approve', $id)
      //     ->orWhere('category', 'university')
      //     ->orWhere('category', 'organization')
      //     ->get();
      // }

      # Return All official or local event
      # within University or organization category
      // if ($id > 0) {
      //   return Event::where('event_type_id', $id)
      //     ->Where('category', 'university')
      //     ->orWhere('category', 'organization')
      //     ->get();
      // }
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
    }

    /**
     * Return the user organizatoin ID
     *
     * @return void
     */
    private function getOrganization()
    {
      return OrganizationGroup::where('user_id', Auth::id())
        ->get()
        ->first()
        ->getOrganizationId();
    }

    /**
     * This method compare the given date to current date
     * and when true, set the status to on going
     *
     * @return void
     */
    private function getDateComparison(&$events)
    {
      if (! is_null($events)) {
        foreach ($events as $key => $event) {
          if (self::matchDate($event->date_start)) {
            $events[$key]->status = "on going";
            # Issue 25
          }
        }
      }
    }

    /**
     * Match the current month with the given month
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
