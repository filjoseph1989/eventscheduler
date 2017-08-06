<?php

namespace App\Http\Controllers\OrganizationAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\OrgAdviserLibrary as Adviser;

# Models
use App\Models\Event;
use App\Models\EventType;
use App\Models\PersonalEvent;
use App\Models\EventCategory;
use App\Models\OrganizationGroup;
use App\Models\OrganizationAdviserGroup;

class EventController extends Controller
{
    private $adviser;

    public function __construct()
    {
      $this->middleware('web');
      $this->adviser = new Adviser();
    }

    /**
     * Display the list of event
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function index($id = null)
    {
      # is adviser loggedin?
      parent::loginCheck();

      # Is the user an adviser?
      $this->adviser->isAdviser();

      $login_type = "user";
      if ($id == null) {
        return view('pages/users/organization-adviser/events/choices', compact(
          'login_type'
        ));
      } else {
        if ($id != 4) {
          $eventCategory = EventCategory::find($id);
          $event         = Event::where('event_category_id', '=', $id)->with('organization')->get();
          return view('pages/users/organization-adviser/events/list', compact(
            'login_type', 'eventCategory', 'event'
          ));
        } elseif ($id == 4) {
          # Issue: 45
          #  Note: Set some event to archive when date is before the current date

          $event = PersonalEvent::where('date_start', '>=', date('m'))
            ->where('user_id', '=', Auth::user()->id)
            ->get();
          return view('pages/users/organization-adviser/events/mylist', compact(
            'login_type', 'event'
          ));
        } else {
          return back();
        }
      }
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      # Is the user loggedin?
      parent::loginCheck();

      # Is the user an adviser?
      $this->adviser->isAdviser();

      $login_type     = 'user';
      $event_type     = EventType::all()->except(1);
      $event_category = EventCategory::all()->except(4);
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

      # is the user rank as adivser?
      $this->adviser->isAdviser();

      # return to form if the following does not satisfy
      if ($data->event_type_id == 0) {
        return back()
          ->withInput()
          ->with('status_warning', 'You must chose type of event');
      }
      if ($data->event_category_id == 0) {
        return back()
          ->withInput()
          ->with('status_warning', 'You must chose the audience for this event');
      }
      if ($data->semester == '0') {
        return back()
          ->withInput()
          ->with('status_warning', 'You must chose for what semester this event');
      }
      if ($data->organization_id == 0) {
        return back()
          ->withInput()
          ->with('status_warning', "Sorry you cannot create event because you are not yet a member of any organization");
      }

      # is the user a member of the given organization?
      if ( ! self::_isMember($data->organization_id)) {
        return back()
          ->withInput()
          ->with('status_warning', "Sorry you are not yet a member of any organization.<br>You need to be a member first");
      }

      # is data entry valid?
      $this->adviser->isValid($data);

      # is the user an adviser to an organization?
      $this->adviser->isAdviserInGivenOrganization($data->organization_id);

      # Get the data from form
      $request = $data->only(
        'user_id', 'event_type_id', 'event_category_id',
        'organization_id', 'title', 'description',
        'venue', 'date_start', 'date_start_time',
        'date_end', 'date_end_time', 'whole_day',
        'notify_via_facebook', 'notify_via_twitter',
        'notify_via_email', 'notify_via_sms', 'semeter'
      );

      # Finally create events
      $result = Event::create($request);

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

    /**
     * Return the list of event type
     * ! Depracated
     *
     * @return
     */
    public function getEventType()
    {
      # is the user loggedin?
      parent::loginCheck();

      $this->adviser->isAdviser();

      # is the user an adviser?
      $login_type     = 'user';
      $event_category = EventCategory::all();

      # Render table of event category
      return view('pages/users/organization-adviser/calendars/events/category', compact(
        'login_type',
        'event_category'
      ));
    }

    /**
     * Determined if this loggedin user
     * is a member of the given organization ID
     *
     * @param  int  $id Organization ID
     * @param boolean $get Used to determine if need to return boolean or redirect
     * @return boolean
     */
    private function _isMember($id)
    {
      $result = OrganizationGroup::where('user_id', '=', Auth::user()->id)
      ->where('organization_id', '=', $id)
      ->where('membership_status', '=', 'yes')
      ->count();

      return $result == 1 ? true : false;
    }
}
