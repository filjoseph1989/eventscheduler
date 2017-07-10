<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

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
    $request = [];
    foreach ($data->form as $key => $value) {
      if (($value['name'] == 'date_start' or $value['name'] == 'date_end') and ! empty($value['value'])) {
        $request[$value['name']] = date( "Y/m/d", strtotime($value['value']));
      } else {
        $request[$value['name']] = $value['value'];
      }
    }
    $request['organization_id'] = 1;

    $result = Event::create($request);

    echo json_encode([
      'wasRecentlyCreated' => $result->wasRecentlyCreated
    ]);
  }

  /**
   * Return the event for the current month
   *
   * @return
   */
  public function getEventOfTheMonth()
  {
    # Code here
  }

  /**
   * return the event from previous month
   * @return
   */
  public function getEventOfPreviousMonth()
  {
    # Code Here
  }

  /**
   * Return the event for the next month
   *
   * @return
   */
  public function getEventOfNextMonth()
  {
    # Code Here
  }

  /**
   * Return the event of the given month
   *
   * @return
   */
  public function getEventOfNextMonth()
  {
    # Code Here
  }
}