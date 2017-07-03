<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageNotification extends Controller
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

  public function showNotificationPage()
  {
    return view('pages.users.organization-head.calendar'); 
  }
}
