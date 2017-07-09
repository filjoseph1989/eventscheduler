<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Manage the events
 *
 * @author jlvoice777
 * @since 0
 * @version 0.1
 */
class EventController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('web');
  }

  /**
   * Receive passed data and create new event
   *
   * @return [type] [description]
   */
  public function createNewEvent(Request $data)
  {
    echo json_encode([
      'data' => $data->form
    ]);
  }
}
