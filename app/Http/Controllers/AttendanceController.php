<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Helpers\RandomHelper;

# Models
use App\Models\User;
use App\Models\Event;
use App\Models\Semester;
use App\Models\EventType;
use App\Models\EventGroup;
use App\Models\Attendance;
use App\Models\OrganizationGroup;

/**
 * Handle attendance request
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.1.0
 * @date 09-27-2017
 * @date 10-15-2017 - Updated
 */
class AttendanceController extends Controller
{
    private $list  = ['official', 'expected', 'confirm', 'decline'];
    private $theme = 'theme-teal';

    /**
     * Build instance of a class
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display the members attendance to different events.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RandomHelper $helper)
    {
      $attendance = Attendance::getMyAttendance(Auth::id());

      return view('my_event_attendance')
        ->with([
          'helper'     => $helper ,
          'attendance' => $attendance
        ]);
    }

    /**
     * Display the specified resource.
     *
     * Display the different attendances
     *
     * @param    $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, RandomHelper $helper)
    {
      /**
       * upon cliking the type of event (whether official, expected, confirmed, or declined),
       * it will direct to a link for what type of event(LOCAL: within or personal, or WITHIN: university or organizations),
       * then by clicking, it will direct the user to the particular list of events he/she is looking for.
       */
      $events = self::getEventsWithOrganization($id);

      // get all user's organization for the dropdown pull right menu of local within orgs in attendance blade
      $user_orgs = self::getUserOrgs(Auth::user()->id);

      return view('attendance')
        ->with([
          'events'    => $events,
          'eventType' => $id,
          'helper'    => $helper,
          'user_orgs' => $user_orgs,
        ]);
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
        $data = [
          'user_id'  => Auth::id(),
          'event_id' => $id,
          'status'   => 'confirmed'
        ];

        $attendance = Attendance::create($data);

        if ($attendance->wasRecentlyCreated) {
          return back()
            ->with([
              'status' => 'See you on the event'
            ]);
        }
    }

    /**
     * this function will display the list of events in a specific organization
     * after the user clicks the organization name linked at the dropdown pull right
     * on the view of Local attendances
     */
    public function showWithinEachOrg($id, RandomHelper $helper) {
        $events = Event::where('organization_id', $id)->where('is_approve', 'true')->with('organization')->where('event_type_id', 2)->with('eventType')->get();
        $user_orgs = self::getUserOrgs(Auth::user()->id);  //{{--  magwork na ni pag naa nay auth  --}}

         return view('attendance')->with([
        'events'       => $events,
        'eventType'    => 'Local',
        'helper'       => $helper,
        'user_orgs'    => $user_orgs, // {{--  magwork na sulod ani pag naa nay auth  --}}
      ]);
    }

    /**
     * Return the list of user in official attendance
     *
     * @param  Request $event
     * @return
     */
    public function getOfficialAttendance(Request $event)
    {
        //get attendance with did_attend == 'true'
        return Attendance::with('user')
            ->where('event_id', $event->id)
            ->where('did_attend', 'true')
            ->get();
    }

    /**
     * Return the confirmed attendance
     *
     * @param Request $event
     * @return \illuminate\response
     */
    public function getConfirmedAttendance(Request $event)
    {
        //get attendance with status == 'confirmed'
        return Attendance::with('user')
            ->where('event_id', '=', $event->id)
            ->where('status', '=', 'confirmed')
            ->get();
    }

    /**
     * Return the declined events
     *
     * @param Request $event
     * @return \Illuminate\Response
     */
    public function getDeclinedAttendance(Request $event)
    {
        //get attendance with status == 'unconfirmed'
        return Attendance::with('user')
            ->where('event_id', '=', $event->id)
            ->where('status', '=', 'unconfirmed')
            ->get();
    }

    /**
     * Return the expexted attendance
     *
     * @param Request $event
     * @return json
     */
    public function getExpectedAttendance(Request $event)
    {
        /**
         * if within org, get all users in the orggroup with the same organization_id with the event's
         * if university / organization, get all users of the system
         */
        $ev = Event::find($event->id);

        if($ev->event_type_id == 1) {
            $data['result'] = User::all();
        } elseif ($ev->event_type_id == 2) {
            $data['result'] = OrganizationGroup::with('user')
            ->where('organization_id', '=', $ev->organization_id)
            ->get();
        }

        $data['event_type'] = $ev->event_type_id;

        echo json_encode($data);
    }

    /**
     * Return the events with organization
     *
     * @param int $id
     * @return void
     */
    private function getEventsWithOrganization($id)
    {
      if ($id == 'Official') {
        return Event::with(['organization', 'eventType'])
          ->where('event_type_id', 1)
          ->where('is_approve', 'true')
          ->get();
      }
      if ($id == 'university') {
        return Event::with(['organization', 'eventType'])
          ->where('event_type_id', 1)
          ->where('category', 'university')
          ->where('is_approve', 'true')
          ->get();
      }
      if ($id == 'organizations') {
        return Event::with(['organization', 'eventType'])
          ->where('event_type_id', 1)
          ->where('category', 'organization')
          ->where('is_approve', 'true')
          ->get();
      }
      if ($id == 'Local') {
        return Event::with(['organization', 'eventType'])
          ->where('event_type_id', 2)
          ->where('is_approve', 'true')
          ->get();
      }
    }

    /**
     * Return the organization of the user
     *
     * @param int $id
     * @return \Illuminate\Response
     */
    private function getUserOrgs($id) {
        return OrganizationGroup::where('user_id', $id)
            ->with('organization')
            ->get();
    }
}
