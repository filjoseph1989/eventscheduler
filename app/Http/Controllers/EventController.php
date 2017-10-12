<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\ValidationTrait;
use App\Helpers\RandomHelper;

# Models
use App\Models\Event;
use App\Models\Semester;
use App\Models\EventType;
use App\Models\EventGroup;

/**
 * CRUDS class for events
 *
 * @author Liz <janicalizdeguzman@gmail.com>
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
      $events = self::getEvents($id);

      self::getOrganization($events);

      return view('events-list')->with([
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
     * Modefy the events
     *
     * @param  objeect $events Reference to events
     * @return void
     */
    private function getOrganization(&$events)
    {
      /*
      need to change this because university events doesn't need eventroups
      use organization_id in events
       */
      foreach ($events as $key => $event) {
        $events[$key]['organization'] = EventGroup::with('organization')
          ->where('event_id', '=', $event->id)
          ->get();
      }
    }

    /**
     * Return array of events
     *
     * @param mixed $id
     * @return void
     */
    private function getEvents($id)
    {
      # Return All event within University or organization category
      if ($id == '0') {
        return Event::Where('category', 'university')
          ->orWhere('category', 'organization')
          ->get();
      }

      # Return All approve or disapprove event
      # within University or organization category
      if ($id == 'true' or $id == 'false') {
        return Event::where('is_approve', $id)
          ->orWhere('category', 'university')
          ->orWhere('category', 'organization')
          ->get();
      }

      # Return All official or local event 
      # within University or organization category
      if ($id > 0) {
        return Event::where('event_type_id', $id)
          ->Where('category', 'university')
          ->orWhere('category', 'organization')
          ->get();
      }
    }
}
