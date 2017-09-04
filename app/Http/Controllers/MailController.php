<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

# MAiler
use App\Mail\Mailtrap;
use App\Mail\EmailNotification;

class MailController extends Controller
{
    /**
     * Send email
     * @return
     */
    public function index(){
      $user = Auth::user();
      Mail::to($user)->send(new EmailNotification());
      // Mail::to('janicalizdeguzman@gmail.com')->send(new Mailtrap());
    }

    // public function send(Request $request)
    // {
    //     $title = $request->input('title');
    //     $content = $request->input('content');
    //
    //     Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
    //     {
    //
    //         $message->from('me@gmail.com', 'Christian Nwamba');
    //
    //         $message->to('chrisn@scotch.io');
    //
    //     });
    //
    //     return response()->json(['message' => 'Request completed']);
    // }
}
