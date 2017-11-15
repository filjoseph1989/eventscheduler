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
    return Event::find($request->id);
  }

}
