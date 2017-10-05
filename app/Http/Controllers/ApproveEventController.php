<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# Models
use App\Models\Event;

/**
 * Written by Liz <janicalizdeguzman@gmail.com>
 *
 * @version 1
 * @date 10-04-2017
 * @date 10-04-2017 Updated
 */
class ApproveEventController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      # Check first who is currently loggedin

      $event = Event::find($id);
      $event->is_approve = 'true';
      if ($event->save()) {
        return back()
          ->with('status', 'Successfully approve the event');
      }
    }
}
