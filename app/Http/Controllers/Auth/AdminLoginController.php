<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;


class AdminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin', ['except'=>['adminLogout']]);
    }

    /**
     * Disaplay the login form
     *
     * @return \Illuminate\Response
     */
    public function showLoginForm()
    {
        session(['class' => 'login-page']);
        return view('auth.admin-login');
    }

    /**
     * Accept the login request
     *
     * @param  Request $request
     * @return \Illuminate\Response
     */
    public function login(Request $request)
    {
        //Validate the form data
        $this->validate($request, [
          'email'    => 'required|email',
          'password' => 'required|min:8'
        ]);

        //Attempt to log the user in
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
          //if successful, then ridirect to their intended location
          return redirect()->intended(route('admin.dashboard'));
        }
        //if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function adminLogout(){
      Auth::guard('admin')->logout();
      return redirect('admin/admin-login');
    }
}
