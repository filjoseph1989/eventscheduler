<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\CommonMethodTrait;

# Models
use App\Models\Event;
use App\Models\PersonalEvent;

/**
 * Used to check event
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0
 * @date 11-14-2017
 * @date 11-19-2017 - updated
 */
class EventCheckerController extends Controller
{
  use CommonMethodTrait;

  /**
   * return event date
   *
   * @param  Request $request
   * @return json
   */
  public function getDate(Request $request)
  {
    $request->date_start = str_replace('/', '-', $request->date_start);
    $event = Event::where('date_start', $request->date_start)
      ->get()
      ->first();

    if (! is_null($event)) {
      $event->date_start = str_replace('-', '/', $event->date_start);
      return $event;
    } else {
      return json_encode([
        'false' => false
      ]);
    }
  }

  /**
   * Return the personal event date
   *
   * @param  Request $request
   * @return json
   */
  public function getPersonalDate(Request $request)
  {
    $request->date_start = str_replace('/', '-', $request->date_start);
    $event = PersonalEvent::where('date_start', $request->date_start)
      ->get()
      ->first();

    if (! is_null($event)) {
      $event->date_start = str_replace('-', '/', $event->date_start);
      return $event;
    } else {
      return json_encode([
        'false' => false
      ]);
    }
  }

  /**
   * Check who is the event creator
   *
   * @param  Request $request
   * @return string
   */
  public function checkEventCreator(Request $request)
  {
    $event = Event::find($request->id);

    echo json_encode([
      'account' => $event->user_id
    ]);
  }
}
