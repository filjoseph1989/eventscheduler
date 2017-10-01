<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# Models
use App\Models\User;
use App\Models\Course;

/**
 * Handle all the request related to a modal
 *
 * @author Liz <janicalizdeguzman0@gmail.com>
 * @date 10-01-2017
 * @date 10-01-2017 - Last updated
 */
class ModalController extends Controller
{
  public function __construct()
  {

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
    return Position::find($data->id);
  }
}
