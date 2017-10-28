<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PersonalEvent;


class PersonalEventController extends Controller
{
  /**
   * Build instance of a class
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

   public function edit($id)
    {
      //we'll get event data here for modal
      return PersonalEvent::with('user')->where('id', $id)->get();
    }
  
     public function update(Request $request, $id)
    {
      $event = PersonalEvent::find($id);

      if ($request->has('facebook')) {
        $event->facebook = ($request->facebook === true) ? 'off' : 'on';
      }
      if ($request->has('twitter')) {
        $event->twitter = ($request->twitter === true) ? 'off' : 'on';
      }
      if ($request->has('sms')) {
        $event->sms = ($request->sms === true) ? 'off' : 'on';
      }
      if ($request->has('email')) {
        $event->email = ($request->email === true) ? 'off' : 'on';
      }
      if ($request->has('facebook_msg')) {
        $event->facebook_msg = $request->facebook_msg;
      }
      if ($request->has('twitter_msg')) {
        $event->twitter_msg = $request->twitter_msg;
      }
      if ($request->has('email_msg')) {
        $event->email_msg = $request->email_msg;
      }
      if ($request->has('sms_msg')) {
        $event->sms_msg = $request->sms_msg;
      }

      if ($event->save()) {
        $result['result'] = true;
      } else {
        $result['result'] = false;
      }

      echo json_encode($result);
    }
}
