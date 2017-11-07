<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

/**
 * Request for event approval in OSA
 *
 * @author Liz <janicalizdeguazman@gmail.com>
 * @version 1.0.0
 * @date 10-14-2017
 * @date 10-14-2017 - updated
 */
class EventRequestApprovalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Update the event status to make request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $event = Event::find($id);
      $event->status = 'requested';

      if ($event->save()) {
        return back()
          ->with('status', 'Successfully sent a request for approval for ' . ucwords($event->title) . ' event.');

      }
    }
}
