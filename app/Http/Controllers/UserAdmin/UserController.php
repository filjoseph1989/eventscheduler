<?php

namespace App\Http\Controllers\UserAdmin;

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


  private $login_type = 'user';

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
      return view('pages/users/user-admin/members/list', compact(
        'user', 'login_type', 'position'
      ));
    }

    return back()->with('status_warning', 'Sorry We couldn\'t find what your looking for.');
  }

  /**
   * return the list of users
   *
   * @return void
   */
  public function assignApprover()
  {
    /*
    Steps:
    1. Check if the user is currently loggedin
    2. Check if the user is an osa personnel

    1. Get the list of the users
    2. Crete table in the blade
    3. Display the users
    */
    return view('pages/users/user-admin/manage-users/assign-approver')->with([
      'login_type' => $this->login_type
    ]);
  }

  /**
   * This is an ajax request response for setting an approver
   * from the list of approvers
   *
   * Issue 79
   *  dapat kani nga function ibalhin ni didto sa jsonController
   *  kay mao man jud ang purpose ato, handling ajax request
   *
   * @return void
   */
  public function setApprover(Request $data)
  {
    /*
    Steps:
    1. Get the user ID
    2. Find the user in the users table given the ID
    3. Set is_approvers column for that user to true
    4. return response
    */
    $result = User::updateOrCreate(
      ['id'          => $data->id],
      ['is_approver' => $data->isApprover]
    );

    if ($result) {
      echo json_encode([
        'status' => true,
        'id'     => $data->id
      ]);
    }
  }
  public function setAccountStatus(Request $data)
  {
    /*
    Steps:
    1. Get the user ID
    2. Find the user in the users table given the ID
    3. Set is_approvers column for that user to true
    4. return response
     */
    $result = User::updateOrCreate(
      ['id' => $data->id],
      ['status' => $data->status]
    );
    
    if ($result) {
      $upd = date("d M Y, h:i A", strtotime($result->updated_at));
      echo json_encode([
        'status' => true,
        'id' => $result->id,
        'updated_at' => $upd
      ]);
    }
  }

}





