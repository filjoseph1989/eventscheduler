<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# Models
use App\Models\Event;
use App\Models\EventGroup;

class EventController extends Controller
{
    private $list = ['all', 'official', 'local'];
    private $theme = 'theme-red';

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
        return  view('events-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
}
