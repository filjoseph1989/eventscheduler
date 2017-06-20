<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Notifications\FacebookPublished;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    session(['class' => 'theme-red']);
    return view('pages.home');
  }

  public function sendNotification()
  {
    $result = User::send();
    echo "Good Job, you poster on facebook!! yeeeeey";
  }
}
