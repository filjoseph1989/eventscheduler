<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

/**
 * Used to check event
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0
 * @date 11-14-2017
 * @date 11-14-2017 - updated
 */
class EventCheckerController extends Controller
{
  public function getDate(Request $request)
  {
    $event = Event::where('date_start', $request->date_start)
      ->get()
      ->first();

    $event->date_start = str_replace('-', '/', $event->date_start);
    return $event;
  }
}