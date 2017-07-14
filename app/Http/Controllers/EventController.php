<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\EventType;
use App\Models\Organization;
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
   * @return json
   */
  public function createNewEvent(Request $data)
  {
    # Reformat submitted date to mysql compatible format
    $request = [];
    foreach ($data->form as $key => $value) {
      if (($value['name'] == 'date_start' or $value['name'] == 'date_end') and ! empty($value['value'])) {
        $request[$value['name']] = date( "Y/m/d", strtotime($value['value']));
      } else {
        $request[$value['name']] = $value['value'];
      }
    }

    # Add the organization ID
    # Issue 26: This should be dynamic and the ID should come from from in view
    $request['organization_id'] = 1;

    # Update the table events
    $result = Event::create($request);

    # Format date for calendar display
    $request['date_start'] = str_replace('/', '-', $request['date_start']);
    $request['date_end']   = str_replace('/', '-', $request['date_end']);

    # Response to HTTP request (ajax)
    echo json_encode([
      'request'            => $request,
      'wasRecentlyCreated' => $result->wasRecentlyCreated
    ]);
  }

  /**
   * Return the event for the current month
   *
   * @return
   */
  public function getEventOfTheMonth($get = false)
  {
    # Issue 23: find a way to make it more laravel
    $event = new Event();
    $event = $event->query("select * from events where date_start = YEAR('".date('YYYY/mm/dd')."')");
    $event = $event->get();

    /*
      $get, distiguish the response between to ajax or not
     */
    if ($get == true) {
      $login_type = 'user';
      return view('pages.users.organization-head.calendars.events.list', compact('login_type', 'event'));
    } else {
      echo json_encode( $event );
    }

  }

  /**
   * Used to response the http request for a single event
   * information
   *
   * @return json
   */
  public function getEvent(Request $data)
  {
    $event = Event::find($data->id);
    $event->load('eventCategory');
    $event->load('eventType');
    $event->load('organization');
    $event->load('user');

    echo json_encode([
      'event' => $event
    ]);
  }
}
