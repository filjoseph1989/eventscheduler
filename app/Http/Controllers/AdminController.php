<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\EventType;
use App\Models\Position;
use App\Models\Department;
use App\Models\UserAccount;
use App\Models\Organization;
use App\Models\EventCategory;
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
          'login_type' => 'admin',
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
      $user = new User();
      $data = $user->select(
        'users.id as user_id',
        'users.user_account_id',
        'user_accounts.name',
        'users.account_number',
        'users.first_name',
        'users.last_name',
        'users.email',
        'users.mobile_number',
        'users.status',
      )
      ->join('user_accounts', 'users.user_account_id', '=', 'user_accounts.id')
      ->get();

      $users      = User::all();
      $login_type = 'admin';
      return view('pages.admin.users.list', compact('login_type','data', 'departmentName', 'allDepartments'));
    }

    public function showAllUserAccountList()
    {
        $user_accounts  = UserAccount::all();
        $login_type     = 'admin';
        return view('pages.admin.user-accounts.list', compact('login_type','user_accounts'));
    }

    public function showAllCourseList()
    {
        $courses  = Course::all();
        $login_type = "admin";
        return view('pages.admin.course.list', compact('login_type','courses'));
    }

    public function showAllDepartmentList()
    {
        $departments  = Department::all();
        $login_type = "admin";
        return view('pages.admin.department.list', compact('login_type','departments'));
    }

    public function showAllPositionList()
    {
        $positions  = Position::all();
        $login_type = "admin";
        return view('pages.admin.position.list', compact('login_type','positions'));
    }

    /**
     * Display the table of organization in the super admin
     * dashboard
     *
     * @return \Illuminate\Response
     */
    public function showAllOrganizationList()
    {
        $organizations = Organization::all();
        return view('pages.admin.organization.list', compact('organizations'));
    }

    public function showAllEvenCategoriesList()
    {
        $event_categories = EventCategory::all();
        $login_type    = "admin";
        return view('pages.admin.event-category.list', compact('login_type','event_categories'));
    }

    public function showAllEventTypeList()
    {
        $event_types = EventType::all();
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
