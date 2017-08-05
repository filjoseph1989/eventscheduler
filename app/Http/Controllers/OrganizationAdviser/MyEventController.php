<?php

namespace App\Http\Controllers\OrganizationAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\OrgAdviserLibrary as Adviser;

# models
use App\Models\EventType;
use App\Models\PersonalEvent;
use App\Models\OrganizationGroup;
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

      $login_type = 'user';
      $event_type = EventType::all();

      return view('pages/users/organization-adviser/events/my_event', compact(
        'login_type', 'event_type'
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
      # is the user login?
      parent::loginCheck();

      # is the user rank as adivser?
      $this->adviser->isAdviser();

      # return to form if the following does not satisfy
      if ($data->event_type_id == 0) {
        return back()
          ->withInput()
          ->with('status_warning', 'You must chose type of event');
      }
      if ($data->semester == '0') {
        return back()
          ->withInput()
          ->with('status_warning', 'You must chose for what semester this event');
      }

      # is data entry valid?
      $this->adviser->isValid($data);

      # Get the data from form
      $request = $data->only(
        "user_id", "title", "description", "venue",
        "date_start", "date_start_time", "date_end", "date_end_time",
        "whole_day", "event_type_id", "category", "semester",
        "notify_via_facebook", "notify_via_twitter", "notify_via_email", "notify_via_sms"
      );

      # Set default date for end date if not given
      $request['date_end']      = ($request['date_end'] == null) ? $request['date_start'] : $request['date_end'];
      $request['date_end_time'] = ($request['date_end_time'] == null) ? "00:00" : $request['date_end_time'];

      # Finally create events
      $result = PersonalEvent::create($request);

      # inform the user what happend
      if ($result->wasRecentlyCreated) {
        return back()->with('status', 'Successfuly added new event');
      } else {
        return back()->with('status_warning', 'Sorry, we have problem saving the event');
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
