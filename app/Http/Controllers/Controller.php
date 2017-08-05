<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

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
        header('Location: '.action('Auth\LoginController@login'));
        exit;
      }

      # Check if login as admin or user
      if (! Auth::guard('web')->check()) {
        header('Location: '.action('Auth\LoginController@login'));
        exit;
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
      if (Auth::check()) {
        $user = User::find(Auth::user()->id);
        return ($user->user_account_id == 2) ? true : false;
      }
    }

    /**
     * Check if the user account type of the loggedin
     * user in organization head
     *
     * @return boolean
     */
    public function isOrgHead()
    {
      if (Auth::check()) {
        $user = User::find(Auth::user()->id);
        return ($user->user_account_id == 3) ? true : false;
      }
    }

    /**
     * Check if the user account type of the loggedin
     * user in member
     *
     * @return boolean
     */
    public function isOrgMember()
    {
      if (Auth::check()) {
        $user = User::find(Auth::user()->id);
        return ($user->user_account_id == 4) ? true : false;
      }
    }

    /**
     * Check if the user account type of the loggedin
     * user in OSa
     *
     * @return boolean
     */
    public function isOrgOsa()
    {
      if (Auth::check()) {
        $user = User::find(Auth::user()->id);
        return ($user->user_account_id == 5) ? true : false;
      }
    }

    /**
     * Check if the account is an approver
     *
     * @return boolean
     */
    protected function isApprover()
    {
      # Check if this OSA account is an approver
      if (User::find(Auth::user()->id)->approver_or_not)
        return true;

      return false;
    }
}
