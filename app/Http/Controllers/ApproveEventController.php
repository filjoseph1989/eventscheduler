<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use Thujohn\Twitter\Facades\Twitter;
use App\Notifications\FacebookPublished;

# Models
use App\Models\Event;
use App\Models\User;

/**
 * Written by Liz <janicalizdeguzman@gmail.com>
 *
 * @version 1
 * @date 10-04-2017
 * @date 10-13-2017 Updated
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
      $event = Event::find($id);

      $event->is_approve = 'true';
      $event->status     = 'upcoming';

      if ($event->save()) {
        $event = Event::with('organization')
          ->where('id', $id)
          ->get();

        # Post on social media
        self::facebookPost($event[0]);
        self::twitterPost($event[0]);

        return back()
          ->with('status', 'Successfully approve the event');
      }
    }

    /**
     * facabook notification
     *
     * @param object $event
     * @return void
     */
    private function facebookPost ($event) {
      if (is_null($event->facebook_msg)) {
        return false;
      }

      User::send([
        'fb_message' => $event->facebook_msg
      ]);
    }

    /**
     * Twitter notification
     *
     * @param object $event
     * @return void
     */
    private function twitterPost($event)
    {
      if (is_null($event->twitter_msg)) {
        return false;
      }

      return Twitter::postTweet([
        'status' => $event->twitter_msg,
        'format' => 'json'
      ]);
    }
}
