<?php

namespace App\Http\Controllers\OrganizationHead;

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
 * @created 8-26-2017
 * @updated 8-26-2017
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
   * This method search teh user table to be used
   * by organization head to add new organization memeber
   *
   * @param  Request $data
   * @return Illuminate\Response
   */
  public function search(Request $data)
  {
    $user = User::with(['course', 'department'])
      ->where('account_number', 'LIKE', '%' . $data->search . '%')
      ->get();

    $position = Position::all();

    if ($user->count() != 0) {
      $login_type = 'user';
      return view('pages/users/organization-head/members/list', compact(
        'user', 'login_type', 'position'
      ));
    }

    return back()->with('status_warning', 'Sorry We couldn\'t find what your looking for.');
  }
}
