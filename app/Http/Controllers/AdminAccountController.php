<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Course;
use App\Models\Department;
use App\Models\Position;
use App\Models\Organization;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
  public function showAllUserList()
  {
    $user = new User();
    $data = $user->select(
      'users.id',
      'users.user_account_id',
      'user_accounts.name',
      'users.account_number',
      'users.first_name',
      'users.last_name',
      'users.email',
      'users.mobile_number',
      'users.deleted_or_not',
      'users.status',
      'users.position_id',
      'positions.id',
      'positions.name as p_name'
      )
      ->join('user_accounts', 'users.user_account_id', '=', 'user_accounts.id')
      ->join('positions', 'users.position_id', '=', 'positions.id')
      ->where('users.deleted_or_not', '=', 1)
      ->where('user_accounts.name', '!=', 'admin')
      ->get();
      $login_type = 'user';
      return view('pages.users.admin-user.users.list', compact('login_type','data'));
  }
  public function showAllCourseList()
  {
      $courses      = Course::where('deleted_or_not', '=', 1)->get();
      $login_type = 'user';
      return view('pages.users.admin-user.course.list', compact('login_type','courses'));
  }
  public function showAllDepartmentList()
  {
      $departments = Department::where('deleted_or_not', '=', 1)->get();
      $login_type = 'user';
      return view('pages.users.admin-user.department.list', compact('login_type','departments'));
  }
  public function showAllPositionList()
  {
      $positions  = Position::where('deleted_or_not', '=', 1)->get();
      $login_type = 'user';
      return view('pages.users.admin-user.position.list', compact('login_type','positions'));
  }
  public function showAllOrganizationList()
  {
      $organizations = Organization::where('deleted_or_not', '=', 1)->get();
      $login_type = 'user';
      return view('pages.users.admin-user.organization.list', compact('login_type','organizations'));
  }
}
