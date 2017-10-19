<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalEventController extends Controller
{
  /**
   * Build instance of a class
   */
  public function __construct()
  {
    $this->middleware('auth');
  }
}
