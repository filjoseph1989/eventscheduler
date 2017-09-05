<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

# MAiler
use App\Mail\Mailtrap;
use App\Mail\EmailNotification;
use App\Models\User;

class MailController extends Controller
{
    /**
     * Send email
     * @return
     */
    public function index(){
      $user = User::find(1);
      Mail::to($user)->send(new EmailNotification());
    }
}
