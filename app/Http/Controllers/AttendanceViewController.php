<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# Models
use App\Models\User;
use App\Models\Event;
use App\Models\Attendance;

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
   * Return official attendance
   *
   * @return Illuminate\Response
   */
  public function getOfficialAttendance($id)
  {
    $events = Event::find($id);
    if ($events->category == 'university') {
      $users = Attendance::where('event_id', $id)
        ->with('user')
        ->get();
    }

    return view('attendees')
      ->with([
        'events' => $events,
        'users'  => isset($users) ? $users : []
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
    if ($events->category == 'university') {
      $users = Attendance::where('event_id', $id)
        ->with('user')
        ->get();
    }

    return view('attendees')
      ->with([
        'events'   => $events,
        'users'    => isset($users) ? $users: [],
        'expected' => true
      ]);
  }
}
