<?php

namespace App\Http\Controllers;
use App\Mail\Mailtrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function index(){
      Mail::to('janicalizdeguzman@gmail.com')->send(new Mail());
    }
}
