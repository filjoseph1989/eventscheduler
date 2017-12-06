<?php

namespace App\Http\Controllers;

use Auth;;
use Illuminate\Http\Request;

# Models
use App\Models\User;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\OrganizationGroup;

/**
 * Manage Attendances
 *
 * @author Liz
 * @version 1.0
 * @date 11-20-2017
 * @date 11-20-2017 - updated
 */
class AttendanceViewController extends Controller
{
  /**
   * Build instance of a class
   */
  public function __construct()
  {
    $this->middleware('auth');
  }


  /**
   * Return attendance sheet,
   * this are the users that officially attend the event
   *
   * @return Illuminate\Response
   */
  public function getAttendanceSheet($id)
  {
    $events = Event::find($id);
    if( $events->organization_id == null ){
      $users  = OrganizationGroup::with('user')->get();
    } else {
      $users  = OrganizationGroup::with('user')
      ->where('organization_id', $events->organization_id)
      ->get();
    }

    $attendance = Attendance::where('event_id', $id)
      ->with('user')
      ->get();

    # remove duplication
    foreach ($users as $ukey => $user) {
      foreach ($attendance as $key => $att) {
        if ($user->user_id == $att->user_id) {
          unset($users[$ukey]);
        }
      }
    }

    return view('attendees')
      ->with([
        'events'     => $events,
        'users'      => isset($users) ? $users : [],
        'expected'   => true,
        'creator'    => ($events->user_id == Auth::id()) ? true: false,
        'attendance' => $attendance,
      ]);
  }

  /**
   * Return official attendance,
   * this are the users that officially attend the event
   *
   * @return Illuminate\Response
   */
  public function getOfficialAttendance($id)
  {
    $event = Event::find($id);
    $users = Attendance::where('event_id', $id)
      ->where('did_attend', 'true')
      ->with('user')
      ->get();

    return view('attendees')
      ->with([
        'events' => $event,
        'users'  => isset($users) ? $users : [],
      ]);
  }

  /**
   * Store confirmation
   *
   * @param  Request $request
   * @return
   */
  public function update(Request $request)
  {
    $event = Event::find($request->event_id);

    $attend = Attendance::where('user_id', $request->id)->first();

    if (! is_null($attend)) {
      $attend->did_attend = (is_bool($request->actual) and $request->actual === true) ? 'true' : 'false';
      if ($attend->save()) {
        $response = true;
      } else {
        $response = false;
      }
    } else {
      $data = [
        'user_id'    => $request->id,
        'event_id'   => $request->event_id,
        'did_attend' =>  (is_bool($request->actual) and $request->actual === true) ? 'true' : 'false',
      ];

      $att = Attendance::create($data);

      if ($att->wasRecentlyCreated) {
        $response = true;
      } else {
        $response = false;
      }
    }

    echo json_encode([
      'response' => $response,
      'actual'  => $request->actual
    ]);
  }

  public function getAttendance(Request $request)
  {
    return Attendance::checkUser(Auth::id(), $request->id);
  }
}
