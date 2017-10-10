<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Notifications\FacebookPublished;

# Models
use App\Models\User;
use App\Models\UserType;
use App\Models\Organization;
use App\Models\OrganizationGroup;

/**
 * A landing controller after loggedin
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 2.0.0
 * @company DevCaffee
 * @date 09-24-2017
 * @date 10-10-2017 - Updated
 */
class HomeController extends Controller
{
    private $status       = "";
    private $account_name = "";
    private $theme        = "";
    private $color        = "";

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
        self::getUserAccountProperty();

         # Does the user is active?
        if (self::isStatus()) {

            session([
              'loginClass'   => $this->theme,
              'user_account' => $this->account_name
            ]);

            # Render View
            return view('home');
        } else {
            # logout and redirect to register page if status is not active
            Auth::guard('web')->logout();

            session(['loginClass' => 'login-page']);

            return redirect()
                ->route('register')
                ->with('status', 'Your registration is not yet complete. </br> Please wait for the confirmation of your account of the administrator');
        }
    }

   /**
     * Is the user who tried to login the system
     * is an active user?
     *
     * @return boolean
     */
    private function isStatus()
    {
        return ($this->status == 'true') ? true : false;
    }

    /**
     * Return the status of the loggedin user
     * @return boolean
     */
    private function getUserAccountProperty()
    {
        $user        = User::find(Auth::user()->id);
        $userAccount = UserType::find($user->user_type_id);

        $this->status       = $user->status;
        $this->account_name = $userAccount->name;
        $this->theme        = $userAccount->theme;
        $this->color        = $userAccount->color;
    }
}
