<?php

namespace App\Http\Controllers\OrganizationMember;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\OrganizationGroup;
use Illuminate\Http\Request;

class OrgMemberAccountController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('web');
  }

  /**
   * Display the list of organization for
   * the organization member
   *
   * @return \Illuminate\Response
   */
  public function DisplayMyOrganization()
  {
    $OrgList = OrganizationGroup::with(['user','organization'])
      ->where('user_id', '=', Auth::user()->id)
      ->get();

    $login_type = "user";
    return view('pages.users.organization-member.calendars.org-list', compact('OrgList', 'login_type'));
  }
}
