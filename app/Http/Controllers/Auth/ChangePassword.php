<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangePassword extends Controller
{
  /**
   * Change the user password
   *
   * @return
   */
  public function changePassword(Request $data)
  {
    # is the user currently login?
    parent::loginCheck();

    # is the password data valid?
    self::_validateRule($data);

    $current_password = Auth::user()->password;
    if(Hash::check($data['old_password'], $current_password)) {
      $user_id            = Auth::user()->id;
      $obj_user           = User::find($user_id);
      $obj_user->password = Hash::make($data['new_password']);
      if ($obj_user->save()) {
        return back()->with('password_status', 'You successfully changed your password');
      }
    } else {
      return back()->with('password_status_warning', 'Please enter correct current password');
    }
  }

  /**
   * Validate the given password data.
   * If the data doesn't match the rule required, return to user
   * previous page
   *
   * @param  object $data
   * @return object Request
   */
  private function _validateRule($data)
  {
    $this->validate($data, [
      'old_password'     => 'required',
      'new_password'     => 'required|same:new_password',
      'confirm_password' => 'required|same:new_password',
    ]);
  }
}
