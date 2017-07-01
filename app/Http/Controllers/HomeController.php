<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Notifications\FacebookPublished;
use App\Http\Controllers\Auth\AdminLoginController;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    /**
     * 1. Check the status of the user
     *  1.a what are the requirement?
     * 2. Check what is the user_account type?
     * 3. Determine what type of dashboard to display
     * @var [type]
     */
    if (self::getIdentity()['status'] == 1) {
      session(['class' => self::getIdentity()['theme']]);
      $login_type = 'user';
      return view('pages.home', compact('login_type'));
    } else {
      Auth::guard('web')->logout();
      return redirect()->route('register');
    }
  }

  public function sendNotification()
  {
    $result = User::send();
    echo "Good Job, you poster on facebook!! yeeeeey";
  }

  /**
   * Return the status of the loggedin user
   * @return boolean
   */
  private function getIdentity()
  {
    $user = User::find(Auth::user()->id);
    $account_id = UserAccount::find($user->user_account_id);
    return [
      'status' => $user->status,
      'theme'  => $account_id->theme,
      'account'=> $account_id->name,
    ];
  }
}
