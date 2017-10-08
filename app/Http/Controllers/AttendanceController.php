<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RandomHelper;

# Models
use App\Models\Event;
use App\Models\Semester;
use App\Models\EventType;
use App\Models\EventGroup;
use App\Models\Attendance;
use App\Models\OrganizationGroup;

class AttendanceController extends Controller
{
    private $list = ['official', 'expected', 'confirm', 'decline'];
    private $theme = 'theme-teal';
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
        //
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

      //get all user's organization for the dropdown pull right menu of local within orgs in attendance blade
    //   $user_orgs = self::getUserOrgs(Auth::user()->id);  //{{--  magwork na ni pag naa nay auth  --}}

    //   self::getOrganization($events);

      $official_att  = self::getOfficialAttendance($events);
      $expected_att  = self::getExpectedAttendance($events);
      $declined_att  = self::getDeclinedAttendance($events);
      $confirmed_att = self::getConfirmedAttendance($events);

      return view('attendance')->with([
        'loginClass'   => 'theme-teal',
        'events'       => $events,
        'eventType'    => $id,
        'official_att' => $official_att,
        'expected_att' => $expected_att,
        'declined_att' => $declined_att,
        'confirmed_att'=> $confirmed_att,
        'helper'       => $helper,
        // 'user_orgs'    => $user_orgs, // {{--  magwork na sulod ani pag naa nay auth  --}}
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

    //I COMMENTED THIS BECAUSE I THINK WE WILL NO LONGER NEED TO TAP EVENTGROUP SINCE ORGANIZATION ID IS ALREADY IN EVENT MODEL
    // private function getOrganization(&$events)
    // {
    //     //need to change this because university events doesn't need eventroups
    //     //use organization_id in events
    //     foreach ($events as $key => $event) {
    //         $events[$key]['organization'] = EventGroup::with('organization')
    //         ->where('event_id', '=', $event->id)
    //         ->get();
    //     }
    // }

    private function getOfficialAttendance($events)
    {
        //get attendance with did_attend == 'true'
        foreach ($events as $key => $event) {
            $events[$key]['users'] = Attendance::with('user')
            ->where('event_id', '=', $event->id)
            ->where('did_attend', '=', 'true')
            ->get();
            // d($events[0]['users']);
        }
        // exit();
    }

    private function getConfirmedAttendance($events)
    {
        //get attendance with status == 'confirmed'
        foreach ($events as $key => $event) {
        $events[$key]['users'] = Attendance::with('user')
          ->where('event_id', '=', $event->id)
          ->where('status', '=', 'confirmed')
          ->get();
        }
    }

    private function getDeclinedAttendance($events)
    {
        //get attendance with status == 'unconfirmed'
        foreach ($events as $key => $event) {
        $events[$key]['users'] = Attendance::with('user')
          ->where('event_id', '=', $event->id)
          ->where('status', '=', 'unconfirmed')
          ->get();
        }
    }

    private function getExpectedAttendance($events)
    {
        /**
         * if within org, get all users in the orggroup with the same organization_id with the event's
         * if university / organization, get all users of the system
         */
         foreach ($events as $key => $event) {
         $events[$key]['users'] = OrganizationGroup::with('user')
          ->where('organization_id', '=', $event->organization_id)
          ->get();
        }
    }

    private function getEventsWithOrganization($id)
    {
      if ($id == 'official') {
        $events = Event::where('event_type_id', 1)->where('is_approve', 'true')->with('organization')->get();
      }
      if ($id == 'university') {
          $events = Event::where('event_type_id', 1)->where('category', 'university')->where('is_approve', 'true')->with('organization')->get();
      }
      if ($id == 'organizations') {
          $events = Event::where('event_type_id', 1)->where('category', 'organization')->where('is_approve', 'true')->with('organization')->get();
      }

      if ($id == 'local') {
        $events = Event::where('event_type_id', 2)->where('is_approve', 'true')->with('organization')->get();
      }
      return $events;
    }

    // private function getUserOrgs($id) {
    //     //  {{--  magwork na ni pag naa nay auth  --}}
    //     $orgs = OrganizationGroup::where('user_id', $id)->with('organization')->get();
    // }   
}
