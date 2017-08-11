<?php

namespace App\Http\Controllers\OrganizationAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

# Models
use App\Models\Event;
use App\Models\EventType;
use App\Models\Organization;
use App\Models\EventCategory;
use App\Models\PersonalEvent;

class AdviserJsonController extends Controller
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
