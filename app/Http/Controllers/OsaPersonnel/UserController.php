<?php

namespace App\Http\Controllers\OsaPersonnel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

# Models
use App\Models\User;
use App\Models\Position;

/**
 * Class for user
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @since 0.1
 * @version 0.1
 * @created 09-13-2017
 * @updated 09-13-2017
 */
class UserController extends Controller
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
   * return the list of users
   *
   * @return void
   */
  public function getUser()
  {
    $userList = User::where()
  }

}
