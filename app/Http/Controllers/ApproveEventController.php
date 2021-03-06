<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Nexmo\Laravel\Facade\Nexmo;
use Thujohn\Twitter\Facades\Twitter;

use App\Notifications\FacebookPublished;
use App\Mail\ApproveEmailNotification;
use App\Common\CommonMethodTrait;

# Models
use App\Models\Event;
use App\Models\User;
use App\Models\OrganizationGroup;

/**
 * Written by Liz <janicalizdeguzman@gmail.com>
 *
 * @version 1
 * @date 10-04-2017
 * @date 10-18-2017 Updated
 */
class ApproveEventController extends Controller
{
    /**
     * create an instance
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

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
        # get the organization name
        $event = Event::with('organization')
          ->where('id', $id)
          ->get();

          if ($event[0]->facebook == 'on') {
            self::facebookPost($event[0]);
          }
          if ($event[0]->twitter == 'on') {
            self::twitterPost($event[0]);
          }
          if ($event[0]->sms == 'on') {
            self::smsPost($event[0]);
          }
          if ($event[0]->email == 'on') {
            self::emailPost($event[0]);
          }

        return back()
          ->with('status', 'Successfully approved ' . ucwords($event[0]->title) . ' '. ucwords($event[0]->category) . ' event.');
      }
    }

    /**
     * facabook notification
     * this will post to the Event Scheduler V1 Facebook Page
     * @param object $event
     * @return void
     */
    protected function facebookPost ($event) {
      $data['fb_message'] = self::smsMessage($event->category, $event);

      if (! is_null($event->img)) {
        User::send($data['fb_message'], $event->img);
      } else {
        User::send($data['fb_message']);
      }
    }

    /**
     * Twitter notification
     * this will post to Schedule Handler Twitter Account
     * @param object $event
     * @return void
     */
    protected function twitterPost($event)
    {
      $tweet = self::twitterMessage($event);

      $withFile = false;

      if (! empty($event->img) and file_exists(public_path('img/social/' . $event->img))) {
        $uploaded_media = Twitter::uploadMedia([
          'media' => File::get(public_path('img/social/' . $event->img))
        ]);

        $withFile = true;
      }

      if ($withFile === true) {
        return Twitter::postTweet([
          'status'    => $tweet,
          'media_ids' => $uploaded_media->media_id_string,
          'format'    => 'json'
        ]);
      } else {
        return Twitter::postTweet([
          'status'    => $tweet,
          'format'    => 'json'
        ]);
      }
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
      if($event->category == 'university' OR $event->category == 'organization') {
       $users = User::where('status', 'true')->get();
      }

      #  # Within organization
        if( $event->organization != null ){
          if($event->category == 'within') {
            $users = OrganizationGroup::with('user')
            ->with('organization')
            ->where('organization_id', $event->organization_id )
            ->get();
          }
        } else { #personal event
          $users = PersonalEvent::with('user')->where('user_id', $event->user_id)->get();
        }

      # Send notification
      self::sendSms($users, $message, $event);
   }

   /**
   * Email notification
   *
   * @param object $event
   * @return void
   */
    protected function emailPost($event)
    {
      if ($event->category == 'organization' OR $event->category == 'university') {
        $users = User::all();
      }

      if( $event->organization != null ){
        if ($event->category == 'within') {
          $users = OrganizationGroup::with('user')
            ->with('organization')
            ->where('organization_id', '=', $event->organization_id )
            ->get();
        }
      } else { #personal event
        $users = PersonalEvent::with('user')
          ->where('user_id', $event->user_id)
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
      return str_limit($message, 250);
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
      if( $event->category == 'university' OR $event->category == 'organization' ){
        foreach($users as $key => $user) {
          Mail::to($user->email) # kani lang nag lahi
            ->send(new ApproveEmailNotification($event));
        }
      } else {
        foreach($users as $key => $user) {
          Mail::to($user->user->email) # kani lang ang lahi
            ->send(new ApproveEmailNotification($event));
        }
      }
    }

    /**
     * Send text messages
     *
     * @param  obj $users
     * @param  string $notification_message
     * @return void
     */
    private function sendSms($users, $message, $event)
    {
      if( $event->category == 'university' OR $event->category == 'organization' ) {
        foreach($users as $key => $user) {
          Nexmo::message()->send([
            'to'   => $user->mobile_number,
            'from' => '639778378388',
            'text' => $message
          ]);
        }
      } else {
        foreach($users as $key => $user) {
          Nexmo::message()->send([
            'to'   => $user->user->mobile_number,
            'from' => '639778378388',
            'text' => $message
          ]);
        }
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
          $heading = "Hello {$event->organization->name}! You have an upcoming event! ";
          break;

        case 'organization':
          $heading = "Hello Student Leaders! You have an upcoming event! ";
          break;

        case 'personal':
          $heading = "Hello {$event->user->full_name}";
          break;
      }

      $new_line = "";
      if ($twit === true) {
        $new_line = "\n";
      }

      if( $event->organization != null){
        $heading .= "{$new_line}{$event->title} headed by {$event->organization->name}.";
      } else {
        $heading .= "{$new_line}{$event->title} headed by {$event->user->full_name}.";
      }

      if ($twit === true) {
        $heading .= "{$new_line}Description: {$event->description}";
      }

      $date_start             = date('M d, Y', strtotime($event->date_start));
      $date_end               = date('M d, Y', strtotime($event->date_end));
      $event->date_start_time = date('h:i A', strtotime($event->date_start_time));
      $event->date_end_time   = date('h:i A', strtotime($event->date_end_time));

      $heading .=
        "{$new_line}Venue: {$event->venue} " .
        "{$new_line}Duration: {$date_start}, {$event->date_start_time} to {$date_end}, {$event->date_end_time} " .
        "{$new_line}{$event->additional_msg_sms} " .
        "{$new_line}Please be guided accordingly. Thank You! ";

      return $heading;
    }
}
