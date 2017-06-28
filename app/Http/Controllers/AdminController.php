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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['class' => parent::getTheme()]);
        return view('pages.admin.admin');
    }

    /**
     * Display all users list in admin dashboard
     *
     * @return \Illuminate\Response
     */
    public function showAllUserList()
    {
        $login_type = 'admin';
        session(['class' => parent::getTheme()]);
        return view('pages.admin.users.list', compact('login_type'));
    }

    public function showAllUserAccountList()
    {
        $login_type = 'admin';
        return view('pages.admin.users-account.list', compact('login_type'));
    }

    public function showAllCourseList()
    {
        $login_type = "admin";
        return view('pages.users.course.list', compact('login_type'));
    }

    public function showAllDepartmentList()
    {
        $login_type = "admin";
        return view('pages.users.department.list', compact('login_type'));
    }

    public function showAllPositionList()
    {
        $login_type = "admin";
        return view('pages.users.position.list', compact('login_type'));
    }

    public function showAllOrganizationList()
    {
        $login_type = "admin";
        return view('pages.users.organization.list', compact('login_type'));
    }

    public function showAllEvenCategoriesList()
    {
        $login_type = 'admin';
        return view('pages.users.event-category.list', compact('login_type'));
    }

    public function showAllEventTypes()
    {
        $login_type = 'admin';
        return view('pages.users.event-type.list', compact('login_type'));
    }

    public function showAllApprovers()
    {
        $login_type = 'admin';
        return view('pages.users.event-categories.list', compact('login_type'));
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
