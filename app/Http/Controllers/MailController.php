<?php

namespace App\Http\Controllers;
use App\Mail\Mailtrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function index(){
      Mail::to('janicalizdeguzman@gmail.com')->send(new Mailtrap());
    }

    public function send(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('me@gmail.com', 'Christian Nwamba');

            $message->to('chrisn@scotch.io');

        });

        return response()->json(['message' => 'Request completed']);
    }
}
