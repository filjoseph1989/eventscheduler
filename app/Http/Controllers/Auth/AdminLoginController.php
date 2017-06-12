<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login()
    {
        //Validate the form data
        $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required|min:6'
        ]);

        //Attempt to log the user in
        Auth::attempt($credentials, $remember);

        //if successful, then ridirect to their intended location

        //if unsuccessful, then redirect back to the login with the form data
    }
}
