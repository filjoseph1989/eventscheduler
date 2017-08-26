<?php

namespace App\Library;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController as User;


# Models
use App\Models\OrganizationGroup;

/**
 * This controller serve as a shared controller to all controller for
 * organization adviser http request.
 *
 * It contains methods that where commonly used among controllers
 *
 * @author Liz N <janicaliznawa@gmail.com>
 * @since 0.1.0
 * @version 0.2
 * @updated 2017-07-29
 */
class OrgMemberLibrary extends Controller
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
   * A private method where it determine if the user currently
   * loggedin in the system is an adviser, return home if not.
   *
   * @return boolean
   */
  public function isOrgMember()
  {
    if ( ! parent::isOrgMember()) {
      header('Location: '.action('HomeController@index'));
      exit;
    }
  }

  /**
   * Determine if the event information is valid for
   * database storage
   *
   * @param  object  $data
   * @return boolean
   */
  public function isValid($data)
  {
    $message = [
      'regex' => "Time should be valid format",
    ];

    $this->validate($data, [
      'title'             => 'Required',
      'description'       => 'Required',
      'venue'             => 'Required',
      'date_start'        => 'required|date|after_or_equal:today',
      'date_end'          => 'nullable|date|after_or_equal:date_start',
      'date_start_time'   => 'filled|date_format:H:i',
      'date_end_time'     => 'nullable|date_format:H:i',
      'whole_day'         => 'nullable',
      'event_type_id'     => 'Required',
      'event_category_id' => 'Filled',
      'organization_id'   => 'Filled',
      'semester'          => 'Required',
    ], $message);
  }

  /**
   * return true if this account is an adviser to the
   * given organization ID
   *
   * @return
   */

  /*
    Issue 38: Review methods below if still in use
   */

  /**
   * Display the personal calendar
   *
   * @return
   */
  public function myPersonalCalendar()
  {
    # Check if the user is loggedin
    parent::loginCheck();

    if (parent::isOrgMember()) {
      return view('pages/users/organization-member/calendars/my-personal-calendar');
    }
  }
}
