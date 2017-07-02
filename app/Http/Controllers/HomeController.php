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
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
     # Check if the status of the user who loggedin is active
     if (self::getIdentity()['status'] == 1) {
       session([
         'name'       => self::getIdentity()['name'],
         'class'      => self::getIdentity()['theme'],
         'color'      => self::getIdentity()['color'],
         'sidebar'    => "components.user-sidebar.".str_replace(' ', '-', self::getIdentity()['name'])."-menu",
         'login_type' => 'user',
       ]);
       return view('pages.home');
     } else { # redirect to register page if status is not active
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
    $user        = User::find(Auth::user()->id);
    $userAccount = UserAccount::find($user->user_account_id);

    return [
      'status' => $user->status,
      'name'   => $userAccount->name,
      'theme'  => $userAccount->theme,
      'color'  => $userAccount->color,
    ];
  }
}
