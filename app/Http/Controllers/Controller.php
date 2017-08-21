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
      return self::accountCheck(2);
    }

    /**
     * Check if the user account type of the loggedin
     * user in organization head
     *
     * @return boolean
     */
    public function isOrgHead()
    {
      return self::accountCheck(3);
    }

    /**
     * Check if the user account type of the loggedin
     * user in member
     *
     * @return boolean
     */
    public function isOrgMember()
    {
      return self::accountCheck(4);
    }

    /**
     * Check if the user account type of the loggedin
     * user in OSa
     *
     * @return boolean
     */
    public function isOrgOsa()
    {
      return self::accountCheck(5);
    }

    /**
     * Check if the account is an approver
     *
     * @return boolean
     */
    protected function isApprover()
    {
      # Check if this OSA account is an approver
      if (User::find(Auth::user()->id)->is_approver == 'true')
        return true;

      return false;
    }

    /**
     * Look for user account
     *
     * @param  int $id User Account ID
     * @return boolean
     */
    private function accountCheck($id)
    {
      if (Auth::check()) {
        $user = User::find(Auth::user()->id);
        return ($user->user_account_id == $id) ? true : false;
      }
    }
}
