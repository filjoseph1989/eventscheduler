<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\ValidationTrait;

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

    private $theme = 'theme-red';

    /**
     * Build instance of a class
     */
    public function __construct()
    {
      # Issue 12
      // if (! isset($login)) {
      //   Redirect(config('app.url')."/home", false);
      // }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('approve-events');
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
        'loginClass' => 'theme-teal',
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
      self::customValidate($request);

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
          'loginClass' => 'theme-teal',
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
      # Issue 16

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
      foreach ($events as $key => $event) {
        $events[$key]['organization'] = EventGroup::with('organization')
          ->where('event_id', '=', $event->id)
          ->get();
      }
    }

    /**
     * Validate the given entries.
     *
     * As you notice I'm just referencing the
     * request to original variable
     *
     * Learn more about pass by Reference
     *
     * @param Request $request
     * @return void
     */
    private function customValidate(&$request)
    {
      $this->validateRequest($this, $request);
    }

    /**
     * Return array of events
     *
     * @param mixed $id
     * @return void
     */
    private function getEvents($id)
    {
      if ($id == '0') {
        $events = Event::all();
      }
      if ($id == 'true' or $id == 'false') {
        $events = Event::where('is_approve', $id)->get();
      }
      if ($id > 0) {
        $events = Event::where('event_type_id', $id)->get();
      }

      return $events;
    }
}

/**
 * Independent functions and not belong to a class
 *
 * @param string  $url
 * @param boolean $permanent
 */
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}
