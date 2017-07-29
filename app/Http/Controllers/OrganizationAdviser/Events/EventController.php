<?php

namespace app\Http\Controllers\OrganizationAdviser\Events;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

# Models
use App\Models\Event;
use App\Models\EventType;
use App\Models\EventCategory;
use App\Models\OrganizationAdviserGroup;

class EventController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      # Is the user loggedin?
      parent::loginCheck();

      # Is the user an adviser?
      self::_isAdviser();

      $login_type     = 'user';
      $event_type     = EventType::all();
      $event_category = EventCategory::all();
      $organization   = OrganizationAdviserGroup::with('organization')
        ->where('organization_adviser_groups.user_id', '=', Auth::user()->id)
        ->get();

      return view('pages/users/organization-adviser/events/form', compact(
        'login_type',
        'event_type',
        'event_category',
        'organization'
      ));
    }

    /**
     * Receive passed data and create new event
     * Issue 40: This method can be combine with self::myNewEvent()
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
      # is the user login?
      parent::loginCheck();

      # is the user rank an adivser
      self::_isAdviser();

      # is data entry valid?
      self::_isValid($data);

      # is this user and adviser to an organization?
      self::_isAdviserInGivenOrganization($data->organization_id);

      # Get the data from form
      $request = $data->only(
        'user_id', 'event_type_id', 'event_category_id',
        'organization_id', 'title', 'description',
        'venue', 'date_start', 'date_start_time',
        'date_end', 'date_end_time', 'whole_day',
        'notify_via_facebook', 'notify_via_twitter',
        'notify_via_email', 'notify_via_sms'
      );

      # Set default value for organization ID to 1 if not given
      $request['organization_id'] = ($data->only('organization_id')['organization_id'] == 0) ? 1 : $data->only('organization_id')['organization_id'];

      # Finally create events
      $result = Event::create($request);

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

    /**
     * return true if this account is an adviser to the
     * given organization ID
     *
     * @return
     */
    private function _isAdviserInGivenOrganization($id)
    {
      $adviser = OrganizationAdviserGroup::where('organization_id', '=', $id)->get();
    }
}
