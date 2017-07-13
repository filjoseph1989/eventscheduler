<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Positions;
use App\Models\Organization;
use App\Models\OrganizationGroup;
use Illuminate\Http\Request;

class OsaAccountController extends Controller
{
  /**
   * Display the list of user on OSA's page|dashboard
   *
   * @return \Illuminate\Response
   */
  public function showAllUserList()
  {
      $organizations = Organization::all();

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
        'users.position_id',
        'positions.id as p_id',
        'positions.name as p_name'
      )
      ->join('user_accounts', 'users.user_account_id', '=', 'user_accounts.id')
      ->join('positions', 'users.position_id', '=', 'positions.id')
      ->where('user_accounts.name', '!=', 'admin')
      ->get();

      $login_type = 'user';
      return view('pages.users.osa-user.users.list', compact('login_type','data', 'organizations'));
  }

  public function showAllOrganizationList()
  {
      $organizations = Organization::all();
      $login_type = 'user';
      return view('pages.users.osa-user.organization.list', compact('login_type','organizations'));
  }
  public function showOrganizationAddForm()
  {
    return view('pages.users.osa-user.organization.add');
  }

  public function addOrganizationToMember(){
    //
  }

  public function addMemberToOrganization(){

  }
}
