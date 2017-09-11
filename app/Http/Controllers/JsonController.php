<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

# Models
use App\Models\Event;
use App\Models\EventType;
use App\Models\Organization;
use App\Models\EventCategory;
use App\Models\PersonalEvent;
use App\Models\EventApprovalMonitor;

class JsonController extends Controller
{
  /**
   * Middleware
   */
  public function __construct()
  {
    $this->middleware('web');
  }

  /**
   * Return a single row of event
   *
   * @param  int $id Event ID
   * @return json
   */
  public function getEventCategory(Request $data)
  {
    if (Auth::check()) {
      return EventCategory::find($data->id);
    }
  }

  /**
   * Return the single row of event type
   *
   * @param  int $id Event Type ID
   * @return json
   */
  public function getEventType(Request $data)
  {
    if (Auth::check()) {
      return EventType::find($data->id);
    }
  }

  /**
   * Return the single row of organization
   *
   * @param  int $id Organization
   * @return json
   */
  public function getOrganization(Request $data)
  {
    if (Auth::check()) {
      return Organization::find($data->id);
    }
  }

  /**
   * Return a single event row
   *
   * @param  Request $data
   * @return json
   */
  public function getEvent(Request $data)
  {
    return Event::where('id', '=', $data->id)
      ->with('user')
      ->with('eventType')
      ->with('eventCategory')
      ->with('organization')
      ->get()
      ->toJson();
  }

  /**
   * Return the list of events
   *
   * @return
   */
  public function getEventList(Request $data)
  {
    # Return Personal Event
    if ($data->option != 'false') {
      if($data->option == 'public'){
        return PersonalEvent::where('category', '=', $data->option)
        ->get()
        ->toJson();
      }
      if($data->option == 'private'){
        return PersonalEvent::where('category', '=', $data->option)
        ->where('user_id', '=', Auth::user()->id)
        ->get()
        ->toJson();
      }
    }

    # Return event that are not public
    if ( $data->id > 1 ) {
      return Event::where('event_category_id', '=', $data->id)
        ->get()
        ->toJson();
    }

    # Return public events
    return Event::where('event_category_id', '=', 1)
      ->get()
      ->toJson();
  }

  /**
   * Return a row of personal event
   *
   * @param  Request $data
   * @return json
   */
  public function getPersonalEvent(Request $data)
  {
    return PersonalEvent::where('id', '=', $data->id)
      ->with('eventType')
      ->get()
      ->toJson();
  }

  public function getApprover(Request $data)
  {
    return EventApprovalMonitor::join('users', 'users.id', '=', 'event_approval_monitors.approvers_id')
      ->where('event_approval_monitors.event_id', '=', $data->id)
      ->get()
      ->toJson();
  }

  /**
   * Update the personal event
   *
   * @return void
   */
  public function updatePersonalEvent(Request $data)
  {
    PersonalEvent::find($data->id)->update([$data->name => $data->value]);
  }

  /**
   * Update the organization event
   *
   * @param  Request $data
   * @return void
   */
  public function updateEvent(Request $data)
  {
    Event::find($data->id)->update([$data->name => $data->value]);
  }
}
