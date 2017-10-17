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
        self::smsPost($event[0]);
        self::emailPost($event[0]);

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
     * Twitter notification
     *
     * @param object $event
     * @return void
     */
    private function twitterPost($event)
    {
      $this->twitter = true;
      $tweet = self::twitterMessage($value);
      $this->twitter = false;
      return Twitter::postTweet(['status' => $tweet, 'format' => 'json']);
    }

    /**
     * make tweet
     *
     * @return void
     */
    private function twitterMessage($event)
    {
      $message = self::smsMessage($event->event_category_id, $event);
      return str_limit($message, 100);
    }

     /**
     * SMS notification
     *
     * @param object $event
     * @return void
     */
    private function smsPost($event)
    {

        # Composr message
        $notification_message = self::smsMessage($event->event_category_id, $event);

        # Public event
        if($event->event_category_id == 1) {
          $users = User::all();
        }

        # Within organization
        if($value->event_category_id == 2) {
          $users = OrganizationGroup::with('user')
              ->where('organization_id', '=', $value->organization_id )
              ->get();
        }

        # Among organization
        if($value->event_category_id == 3){
          $users = OrganizationGroup::with('user')->get();
        }

        # Personal event
        if($value->event_category_id == 4){
          $notification_message = self::smsMessage($value->event_category_id, $event);
        }

        # Send notification
        self::sendSms($users, $notification_message);
    }

    
     /**
     * Email notification
     *
     * @param object $event
     * @return void
     */
    private function emailPost($event)
    {
      if($value->category == 'university' || $value->category == 'organization') {
        $users = User::all();
      }

      if($value->category == 'within') {
        $users = OrganizationGroup::with('user')
          ->where('organization_id', '=', $value->organization_id )
          ->get();
      }

      self::sendEmail($users);
    }

    private function sendEmail($users)
    {
      foreach($users as $key => $val ) {
        Mail::to($val->user->email)->send(new Mailtrap($value));
      }
    }

  private function smsMessage($category, $event)
  {
    switch ($category) {
      case 'university':
        $heading = "Hello UP Mindanao! You have an upcoming event! ";
        break;

      case 'within':
        $heading = "Hello {$event->organization->name}! You have an upcoming event!";
        break;

      case 'organization':
        $heading = "Hello Student Leaders! You have an upcoming event!";
        break;
    }

    $new_line = "";
    if (! $this->twitter) {
      $new_line = "\n";
    }
 
    $heading .=
      "{$new_line}{$event->title} headed by {$event->organization->name}.";
      if (! $this->twitter) {
        $heading .= "{$new_line}Description: {$event->description}";
      }

    $heading .=
      "{$new_line}Venue: {$event->venue}" .
      "{$new_line}Duration: {$event->date_start}, {$event->date_start_time} to {$event->date_end}, {$event->date_end_time} " .
      "{$new_line}{$event->additional_msg_sms}" .
      "{$new_line}Please be guided accordingly. Thank You!";

    return $heading;
  }

  private function sendSms($users, $notification_message)
  {
    foreach($users as $key => $user) {
      Nexmo::message()->send([
        'to'   => $user->user->mobile_number,
        'from' => '639778378388',
        'text' => $notification_message
      ]);
    }
  }
}
