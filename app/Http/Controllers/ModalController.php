<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# Models
use App\Models\User;
use App\Models\Event;
use App\Models\Course;
use App\Models\Position;
use App\Models\Organization;
use App\Models\OrganizationGroup;

/**
 * Handle all the request related to a modal
 *
 * @author Liz <janicalizdeguzman0@gmail.com>
 * @date 10-01-2017
 * @date 10-01-2017 - Last updated
 */
class ModalController extends Controller
{
   /**
    * Build instance of a class
    */
   public function __construct()
   {
     $this->middleware('auth');
   }

  /**
   * Return the information of the user
   *
   * @param Request $data
   * @return void
   */
  public function getUser(Request $data)
  {
    return User::with([
      'course',
      'userType',
      'organizationGroup' => function($query) {
        return $query->with(['position', 'organization'])->get();
      }
    ])->where('id', $data->id)
      ->get();

  }

  /**
   * Return course information
   *
   * @param Request $data
   * @return json
   */
  public function getCourse(Request $data)
  {
    return Course::find($data->id);
  }

  /**
   * return the position information
   *
   * @param  Request $data
   * @return json
   */
  public function getPosition(Request $data)
  {
    return Position::find($data->id);
  }

  /**
   * Return organization information
   *
   * @param  Request $data
   * @return json
   */
  public function getOrganization(Request $data)
  {
    return Organization::find($data->id);
  }

  /**
   * Return the list of user attendance list
   *
   * Issue 32
   *
   * @param  Request $data
   * @return json
   */
  public function getAttendance(Request $data)
  {
    $event        = Event::find($data->id);
    $organization = Organization::find($event->organization_id);

    return OrganizationGroup::with('user')
      ->where('organization_id', $organization->id)
      ->get()
      ->toJson();
  }
}
