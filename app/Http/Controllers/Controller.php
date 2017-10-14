<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

use Auth;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Check if the user account type of the loggedin
     * user in organization head
     *
     * @return boolean
     */
    public function isOrgHead()
    {
      return self::accountCheck(1);
    }

    /**
     * Check if the user account type of the loggedin
     * user in adviser/org member/org co-adviser
     *
     * @return boolean
     */
    public function isOrgMember()
    {
      return self::accountCheck(2);
    }

    /**
     * Check if the user account type of the loggedin
     * user in OSa
     *
     * @return boolean
     */
    public function isOsa()
    {
      return self::accountCheck(3);
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
        $user = User::find(Auth::id());
        return ($user->user_type_id == $id) ? true : false;
      }
    }

}
