<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Position;
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
    $organizations       = Organization::all();
    $organization_groups = new OrganizationGroup();
    $positions           = Position::all();
    $user_accounts       = UserAccount::all();
    $user                = new User();

    $data = $user->select(
      'users.id as user_id',
      'users.user_account_id as u_acc_id',
      'user_accounts.name as u_acc_name',
      'users.account_number',
      'users.first_name',
      'users.last_name',
      'users.email',
      'users.mobile_number',
      'users.status'
    )
    ->join('user_accounts', 'users.user_account_id', '=', 'user_accounts.id')
    ->where('user_accounts.name', '!=', 'admin')
    ->get();

    $org_grps = $organization_groups->select(
      'organization_groups.id as org_grp_id',
      'organization_groups.user_id as og_user_id',
      'organization_groups.organization_id as og_org_id',
      'organization_groups.position_id as og_pos_id',
      'organizations.name as org_name',
      'positions.name as pos_name',
      'users.first_name as user_fname',
      'users.middle_name as user_mname',
      'users.last_name as user_lname',
      'users.suffix_name as user_sname'
    )
    ->join('users', 'organization_groups.user_id', '=', 'users.id')
    ->join('organizations', 'organization_groups.organization_id', '=', 'organizations.id')
    ->join('positions', 'organization_groups.position_id', '=', 'positions.id')
    ->get();

    $login_type = 'user';
    return view('pages.users.osa-user.users.list', compact('login_type','data', 'organizations', 'positions', 'org_grps', 'user_accounts'));
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

  public function getOrganizationGroup(){
    $organization_group = new OrganizationGroup();
    $org_grp = $organization_group->select(
      'organization_groups.id as org_g_id',
      'organization_groups.user_id as orgg_user_id',
      'organization_groups.organization_id as orgg_org_id'
    )
    ->join('users', 'organization_groups.user_id', '=', 'users.id')
    ->join('organizations', 'organization_groups.organization_id', '=', 'organizations.id')
    ->get();
  }
}
