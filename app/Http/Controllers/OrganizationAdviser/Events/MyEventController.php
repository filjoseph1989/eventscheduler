<?php

namespace App\Http\Controllers\OrganizationAdviser\Events;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

# models
use App\Models\EventType;
use App\Models\PersonalEvent;
use App\Models\OrganizationAdviserGroup;

/**
 * My event controller handles the logic for advisers my events
 *
 * @author Liz N <janicaliznawa@gmail.com>
 * @since 0.1.0
 * @version 0.1.0
 * @create 2017-07-29
 * @update 2017-07-29
 */
class MyEventController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Return form for creating personal event in
     * adviser account
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      # Is the user loggedin?
      parent::loginCheck();

      # return home if not an organization adviser
      self::_isAdviser();

      $login_type   = 'user';
      $event_type   = EventType::all();
      $organization = OrganizationAdviserGroup::with('organization')
        ->where('organization_adviser_groups.user_id', '=', Auth::user()->id)
        ->get();

      return view('pages/users/organization-adviser/events/my_event', compact(
        'login_type',
        'event_type',
        'organization'
      ));
    }

    /**
     * Store new event information to table personal_events
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
      # is the user currently login?
      parent::loginCheck();

      # return home if not an adviser
      self::_isAdviser();

      # is data valid entry?
      self::_isValid($data);

      $event = $data->only([
        "user_id", "title", "description", "venue",
        "date_start", "date_start_time", "date_end", "date_end_time",
        "whole_day", "event_type_id", "category", "semester",
        "notify_via_facebook", "notify_via_twitter", "notify_via_email", "notify_via_sms"
      ]);

      $event['date_end']      = ($event['date_end'] == null) ? $event['date_start'] : $event['date_end'];
      $event['date_end_time'] = ($event['date_end_time'] == null) ? "00:00" : $event['date_end_time'];

      # the user chose a kind of event?
      if ($event['event_type_id'] == 0) {
        return back()->withInput()->with('status_warning', "You need to chose type of event");
      }

      # Save the event
      $event = PersonalEvent::create($event);
      if ($event->wasRecentlyCreated) {
        return back()->with('status', 'Successfuly Saved');
      } else {
        return back()->with('status', "Sorry, there's a problem on saving");
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
        //
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
     * A private method where it determine if the user currently
     * loggedin in the system is an adviser, return home if not.
     *
     * @return boolean
     */
    private function _isAdviser()
    {
      if (! parent::isOrgAdviser()) {
        return redirect()->route('home');
      }
    }

    /**
     * Determine if the event information is valid for
     * database storage
     *
     * @param  object  $data
     * @return boolean
     */
    private function _isValid($data)
    {
      $message = [
        'regex' => "Time should be valid format",
      ];

      $this->validate($data, [
        'title'           => 'Required',
        'description'     => 'Required',
        'venue'           => 'Required',
        'date_start'      => 'required|date|after_or_equal:today',
        'date_end'        => 'nullable|date|after_or_equal:date_start',
        'date_start_time' => 'filled|date_format:H:i',
        'date_end_time'   => 'nullable|date_format:H:i',
      ], $message);
    }
}
