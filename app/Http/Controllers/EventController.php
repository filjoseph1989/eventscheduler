<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\ValidationClass;

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
    private $list  = ['all', 'official', 'local'];
    private $theme = 'theme-red';
    private $validation;

    public function __construct()
    {
      $this->validation = new ValidationClass();
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
        /*
          Steps:
          1. Check if the user is loggedin
          2. Check if the user account is an osa
         */

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
      /*
      Steps:
      Issue 11
      1. Check if the user is loggedin
      2. Check if the user's account is osa
      3. validate the entry and return data
      4. save to database
       */

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
        /*
          Steps:
          1. Check if the user is loggedin
          2. Check if the user account is an osa
         */

        if ($id == 0) {
          $events = Event::all();
        } else {
          $events = Event::where('event_type_id', $id)->get();
        }

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
        //
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
        //
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
      $this->validation->validate($this, $request);
    }
}
