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
class OrgHeadLibrary extends Controller
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
   * loggedin in the system is an organization head, return home if not.
   *
   * @return boolean
   */
  public function isOrgHead()
  {
    if ( ! parent::isOrgHead()) {
      header('Location: '.action('HomeController@index'));
      exit;
    }
  }
}
