<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Check if the user is currently login or not
     *
     * @return
     */
    public function loginCheck()
    {
      # Check if the user is loggedin
      if (! Auth::check()) {
        return redirect()->route('login');
      }

      # Check if login as admin or user
      if (! Auth::guard('web')->check()) {
        return redirect()->route('login');
      }
    }

    /**
     * Check if the user account type of the loggedin
     * user in adviser
     *
     * @return boolean
     */
    public function isOrgAdviser()
    {
      $user = User::find(Auth::user()->id);
      return ($user->user_account_id == 2) ? true : false;
    }

    /**
     * Check if the user account type of the loggedin
     * user in organization head
     *
     * @return boolean
     */
    public function isOrgHead()
    {
      $user = User::find(Auth::user()->id);
      return ($user->user_account_id == 3) ? true : false;
    }

    /**
     * Check if the user account type of the loggedin
     * user in member
     *
     * @return boolean
     */
    public function isOrgMember()
    {
      $user = User::find(Auth::user()->id);
      return ($user->user_account_id == 4) ? true : false;
    }

    /**
     * Check if the user account type of the loggedin
     * user in OSa
     *
     * @return boolean
     */
    public function isOrgOsa()
    {
      $user = User::find(Auth::user()->id);
      return ($user->user_account_id == 5) ? true : false;
    }
}
