<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        session(['class' => parent::getTheme()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.admin');
    }

    /**
     * Display all users list in admin dashboard
     *
     * @return \Illuminate\Response
     */
    public function showAll()
    {
        $login_type = 'admin';
        return view('pages.users.users-list', compact('login_type'));
    }

    /**
     * Display the user form for registration
     *
     * @return
     */
    public function showRegisterForm()
    {
        $login_type = 'admin';
        return view('pages.forms.users.register', compact('login_type'));
    }
}
