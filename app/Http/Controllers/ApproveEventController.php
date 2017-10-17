<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Nexmo\Laravel\Facade\Nexmo;
use Thujohn\Twitter\Facades\Twitter;

use App\Notifications\FacebookPublished;
use App\Mail\ApproveEmailNotification;

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

        // Issue 28

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
    protected function facebookPost ($event) {
      $data['fb_message'] = self::smsMessage($event->category, $event);
      User::send($data['fb_message']);
    }

    /**
     * Twitter notification
     *
     * @param object $event
     * @return void
     */
    protected function twitterPost($event)
    {
      $tweet = self::twitterMessage($event);

      return Twitter::postTweet([
        'status' => $tweet,
        'format' => 'json'
      ]);
    }

    /**
    * SMS notification
    *
    * @param object $event
    * @return void
    */
   protected function smsPost($event)
   {
       # Composr message
       $message = self::smsMessage($event->category, $event);

       # Public event
       if($event->category == 'university') {
         $users = User::all();
       }

       /*
       Unsa pa gali ni 'within' nga category?
       og and 'organization'
        */

       # Within organization
       if($event->category == 'within') {
         $users = OrganizationGroup::with('user')
             ->where('organization_id', '=', $value->organization_id )
             ->get();
       }

       # Send notification
       self::sendSms($users, $message);
   }

   /**
   * Email notification
   *
   * @param object $event
   * @return void
   */
    protected function emailPost($event)
    {
      if ($event->category == 'university' || $event->category == 'organization') {
        $users = User::all();
      }

      if ($event->category == 'within') {
        $users = OrganizationGroup::with('user')
          ->where('organization_id', '=', $event->organization_id )
          ->get();
      }

      self::sendEmail($users, $event);
    }

    /**
     * make tweet
     *
     * @return void
     */
    private function twitterMessage($event)
    {
      $message = self::smsMessage($event->category, $event, true);
      return str_limit($message, 100);
    }

    /**
     * Send email to a User
     *
     * @param  object $users
     * @param object $event
     * @return void
     */
    private function sendEmail($users, $event)
    {
      foreach($users as $key => $user) {
        Mail::to($user->email)
          ->send(new ApproveEmailNotification($event));
      }
    }

    /**
     * Send text messages
     *
     * @param  obj $users
     * @param  string $notification_message
     * @return void
     */
    private function sendSms($users, $message)
    {
      foreach($users as $key => $user) {
        Nexmo::message()->send([
          'to'   => $user->mobile_number,
          'from' => '639778378388',
          'text' => $message
        ]);
      }
    }

    /**
     * Compose a message
     *
     * @param  string $category
     * @param  object $event
     * @return string
     */
    private function smsMessage($category, $event, $twit = false)
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
      if ($twit === true) {
        $new_line = "\n";
      }

      $heading .= "{$new_line}{$event->title} headed by {$event->organization->name}.";

      if ($twit === true) {
        $heading .= "{$new_line}Description: {$event->description}";
      }

      $heading .=
        "{$new_line}Venue: {$event->venue}" .
        "{$new_line}Duration: {$event->date_start}, {$event->date_start_time} to {$event->date_end}, {$event->date_end_time} " .
        "{$new_line}{$event->additional_msg_sms}" .
        "{$new_line}Please be guided accordingly. Thank You!";

      return $heading;
    }
}
