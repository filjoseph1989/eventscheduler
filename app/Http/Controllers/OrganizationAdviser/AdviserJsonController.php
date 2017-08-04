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
  public function getEventList(Request $data)
  {
    return Event::where('id', '=', $data->id)
      ->with('user')
      ->with('eventType')
      ->with('eventCategory')
      ->with('organization')
      ->get()
      ->toJson();
  }
}
