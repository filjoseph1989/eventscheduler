<?php

namespace App\Http\Controllers\OrganizationAdviser\Events;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrganizationAdviser\OrgAdviserAccountController as Adviser;

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
    private $adviser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('web');
      $this->adviser = new Adviser();
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
      $this->adviser->isAdviser();

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
      $this->adviser->isAdviser();

      # is data valid entry?
      $this->adviser->isValid($data);

      # Get data from the submitted entry
      $event = $data->only([
        "user_id", "title", "description", "venue",
        "date_start", "date_start_time", "date_end", "date_end_time",
        "whole_day", "event_type_id", "category", "semester",
        "notify_via_facebook", "notify_via_twitter", "notify_via_email", "notify_via_sms"
      ]);

      # Set default date for end date if not given
      $event['date_end']      = ($event['date_end'] == null) ? $event['date_start'] : $event['date_end'];
      $event['date_end_time'] = ($event['date_end_time'] == null) ? "00:00" : $event['date_end_time'];

      # the user chose a kind of event?
      if ($event['event_type_id'] == 0) {
        return back()->withInput()->with('status_warning', "You need to chose type of event");
      }

      # Finally create event
      $event = PersonalEvent::create($event);

      # inform the user of what happend
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
}
