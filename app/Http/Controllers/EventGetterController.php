<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\CommonMethodTrait;
use App\Models\Event;

/**
 * Used to check event
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0
 * @date 11-15-2017
 * @date 11-15-2017 - updated
 */
class EventGetterController extends Controller
{
  use CommonMethodTrait;

  /**
   * Return the details of event for editing
   *
   * @param  Request $request
   * @return json
   */
  public function getEvent(Request $request)
  {
    $event = Event::find($request->id);

    $event->date_start      = str_replace('-', '/', $event->date_start);
    $event->date_end        = str_replace('-', '/', $event->date_end);
    $event->date_start_time = date('h:i', strtotime($event->date_start_time));
    $event->date_end_time   = date('h:i', strtotime($event->date_end_time));

    return $event;
  }

}
