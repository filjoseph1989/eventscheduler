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
      $event = Event::find($id);

      $event->is_approve = 'true';
      $event->status     = 'upcoming';

      if ($event->save()) {
        $event = Event::with('organization')
          ->where('id', $id)
          ->get();

        self::facebookPost($event[0]);

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
      $data['fb_message'] = self::smsMessage($event->category, $event);
      User::send($data['fb_message']);
    }

    /**
     * Compose message post or notification
     *
     * @param [type] $category
     * @param [type] $event
     * @return void
     */
    private function smsMessage($category, $event)
    {
      switch ($category) {
        case 'university':
          $heading = "Hello UP Mindanao! You have an upcoming event! ";
          break;
        case 'within':
          $heading = "Hello UP Mindanao! You have an upcoming event! ";
          break;
        case 'organization':
          $heading = "Hello UP Mindanao! You have an upcoming event! ";
          break;
        case 'personal':
          $heading = "Hello UP Mindanao! You have an upcoming event! ";
          break;

        case 1:
          $heading = "Hello UP Mindanao! You have an upcoming event! ";
          break;

        case 2:
          $heading = "Hello {$event->organization->name}! You have an upcoming event!";
          break;

        case 3:
          $heading = "Hello Student Leaders! You have an upcoming event!";
          break;

        case 4:
          $heading = "Hello {$event->fname}! Your {$value->title} event has been approved.";
          break;
      }

      $new_line = "";

      $heading .=
        "{$new_line}{$event->title} headed by {$event->organization->name}." .
        "{$new_line}Venue: {$event->venue}" .
        "{$new_line}Duration: {$event->date_start}, {$event->date_start_time} to {$event->date_end}, {$event->date_end_time} " .
        "{$new_line}{$event->facebook_msg}" .
        "{$new_line}Please be guided accordingly. Thank You!";

      return $heading;
    }
}
