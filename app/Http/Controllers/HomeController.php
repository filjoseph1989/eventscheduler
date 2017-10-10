<?php

namespace App\Http\Controllers;

// use Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\FacebookPublished;

use Auth;

# Models
use App\Models\User;
use App\Models\UserType;
use App\Models\Organization;
use App\Models\OrganizationGroup;

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
        $theme = UserType::find(Auth::user()->user_type_id);
        session(['loginClass' => $theme->theme]);

        # Is the user loggedin?
        // parent::loginCheck();

         # Does the user is active?
        if (self::isIdStatus()) {
            # Prepare session
            session([
                'name'       => self::getIdentity()['name'],
                'class'      => self::getIdentity()['theme'],
                'color'      => self::getIdentity()['color'],
                'sidebar'    => self::getSideBar(),
                'info_box'   => self::getInfoBox(),
                'login_type' => 'user',
            ]);

            # Render View
            return view('home')->with([
                'notification' => self::getNotification(),
            ]);
        } else {
            # logout and redirect to register page if status is not active
            Auth::guard('web')->logout();

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
        private function isIdStatus()
        {
            return (self::getIdentity()['status'] == 'true') ? true : false;
        }

        /**
         * Return the sidebar name, base on the account type
         *
         * @return string
         */
        private function getSideBar()
        {
            return "components.user-sidebar.".str_replace(' ', '-', self::getIdentity()['name'])."-menu";
        }

        /**
         * Return the info box name, base on the user account type
         *
         * @return string
         */
        private function getInfoBox()
        {
            return "components.info-box.".str_replace(' ', '-', self::getIdentity()['name'])."";
        }

    /**
     * Return the status of the loggedin user
     * @return boolean
     */
    private function getIdentity()
    {
        $user        = User::find(Auth::user()->id);
        $userAccount = UserType::find($user->user_type_id);
    
        return [
        'status' => $user->status,
        'name'   => $userAccount->name,
        'theme'  => $userAccount->theme,
        'color'  => $userAccount->color,
        ];
    }

     

     /**
     * Get the User notification
     *
     * @return void
     */
    private function getNotification()
    {
        $notification = OrganizationGroup::with('organization')
        ->where('user_id', '=', Auth::user()->id)
        // ->where('membership_status', '=', 'no')
        ->get();

        foreach ($notification as $key => $value) {
        $notification[$key]->title = "You're invited to join <br>{$value->organization->name}";
        $notification[$key]->icon  = "mail_outline";
        }

        return $notification;

        // d($notification);
    }
}
