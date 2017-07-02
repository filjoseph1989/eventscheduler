<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAccount;
use App\Models\Course;
use App\Models\Department;
use App\Models\Position;
use App\Models\Organization;
use App\Models\EventCategory;
use App\Models\EventType;
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
        session([
          'class'      => 'theme-black',
          'login_type' => 'admin'
        ]);
        return view('pages.admin.admin');
    }

    /**
     * Display all users list in admin dashboard
     *
     * @return \Illuminate\Response
     */
    public function showAllUserList()
    {
        $users      = User::where('deleted_or_not', '=', 1)->get();
        $login_type = 'admin';
        return view('pages.admin.users.list', compact('login_type','users'));
    }

    public function showAllUserAccountList()
    {
        $user_accounts  = UserAccount::where('deleted_or_not', '=', 1)->get();
        $login_type     = 'admin';
        return view('pages.admin.user-accounts.list', compact('login_type','user_accounts'));
    }

    public function showAllCourseList()
    {
        $courses  = Course::where('deleted_or_not', '=', 1)->get();
        $login_type = "admin";
        return view('pages.admin.course.list', compact('login_type','courses'));
    }

    public function showAllDepartmentList()
    {
        $departments  = Department::where('deleted_or_not', '=', 1)->get();
        $login_type = "admin";
        return view('pages.admin.department.list', compact('login_type','departments'));
    }

    public function showAllPositionList()
    {
        $positions  = Position::where('deleted_or_not', '=', 1)->get();
        $login_type = "admin";
        return view('pages.admin.position.list', compact('login_type','positions'));
    }

    public function showAllOrganizationList()
    {
        $organizations = Organization::where('deleted_or_not', '=', 1)->get();
        $login_type = "admin";
        return view('pages.admin.organization.list', compact('login_type','organizations'));
    }

    public function showAllEvenCategoriesList()
    {
        $event_categories = EventCategory::where('deleted_or_not', '=', 1)->get();
        $login_type    = "admin";
        return view('pages.admin.event-category.list', compact('login_type','event_categories'));
    }

    public function showAllEventTypeList()
    {
        $event_types = EventType::where('deleted_or_not', '=', 1)->get();
        $login_type = 'admin';
        return view('pages.admin.event-type.list', compact('login_type','event_types'));
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
