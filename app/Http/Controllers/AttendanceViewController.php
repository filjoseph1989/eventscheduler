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
   * Display the expected attendance
   *
   * @param  int $id
   * @return Illuminate\Response
   */
  public function getExpectedAttendance($id)
  {
    $events = Event::find($id);
    $users  = Attendance::with('user')
      ->where('event_id', $id)
      ->where(function($query) {
        return $query
          ->where('status', 'confirmed')
          ->orWhere('did_attend', 'true');
      })
      ->get();

    return view('attendees')
      ->with([
        'events'   => $events,
        'users'    => isset($users) ? $users : [],
        'expected' => true,
        'creator'  => ($events->user_id == Auth::id()) ? true : false,
      ]);
  }

  /**
   * Return the list of attendees who confirmed attendance
   *
   * @param int $id
   * @return Illuminate\Response
   */
  public function getConfirmedAttendance($id)
  {
    $event = Event::find($id);
    $users  = Attendance::with('user')
      ->where('event_id', $id)
      ->where('status', 'confirmed')
      ->where('did_attend', 'false')
      ->get();

    return view('attendees')
      ->with([
        'events'    => $event,
        'users'     => isset($users) ? $users : [],
        'confirmed' => true
      ]);
  }

  /**
   * Return the list of attendees who declined attendance
   *
   * @param int $id
   * @return Illuminate\Response
   */
  public function getDeclinedAttendance($id)
  {
    $event = Event::find($id);
    $users  = Attendance::with('user')
      ->where('event_id', $id)
      ->where('status', 'declined')
      ->get();

    return view('attendees')
      ->with([
        'events'   => $event,
        'users'    => isset($users) ? $users : [],
        'declined' => true
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

    if ($event->user_id == Auth::id()) {
      $attend = Attendance::find($request->id);
      $attend->did_attend = 'true';

      if ($attend->save()) {
        $response = true;
      } else {
        $response = false;
      }
    } else {
      $response = false;
    }

    echo json_encode([
      'response' => $response
    ]);
  }

  public function getAttendance(Request $request)
  {
    return Attendance::checkUser(Auth::id(), $request->id);
  }
}
