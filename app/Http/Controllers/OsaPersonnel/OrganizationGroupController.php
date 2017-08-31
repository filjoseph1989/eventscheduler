<?php

namespace App\Http\Controllers\OsaPersonnel;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\OsaPersonnelLibrary as OsaPersonnel;

# Models
use App\Models\OrganizationGroup;

/**
 * This class controller handles all the Http request
 * related to organization group
 */
class OrganizationGroupController extends Controller
{
    private $osa_personnel;

    /**
     * Construct an object
     */
    public function __construct()
    {
        $this->middleware('web');
        $this->osa_personnel = new OsaPersonnel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      # Get user organization
      $org = OrganizationGroup::with('organization')
        ->where('user_id', Auth::user()->id)
        ->get();

      # Get members
      if (isset($org[0])) {
        $org    = $org[0];
        $member = OrganizationGroup::getMembers($org->organization_id);
      } else {
        $org = false;
      }

      $login_type = 'user';
      return view('pages/users/osa-user/organization/members', compact(
        'org', 'login_type', 'member'
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $login_type = 'user';
      return view('pages/users/osa-user/members/add', compact(
        'org', 'login_type', 'member'
      ));
    }

    /**
     * Store a new membership request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      # make sure a user is Login
      parent::loginCheck();

      # make the user is an adviser
      $this->osa_personnel->isOsaPersonnel();

      # Check wether this user already requested for membership
      if (self::_isAlreadyRequested($request->organization_id)) {
        return back()->with('status_warning', 'You already sent a request for membership');
      }

      # if ever the value of the given field in not 'no'
      if ($request->membership_status != 'no') {
        $request->membership_status = 'no';
      }

      # Store new request
      $result = OrganizationGroup::create(
        $request->only( 'user_id', 'organization_id', 'membership_status' )
      );

      # notify the user what happend
      if ($result->wasRecentlyCreated) {
        return back()->with('status', 'Request successfully sent');
      }

      return back()->with('status_warning', 'Request for membership is not posible for a moment');
    }

    /**
     * Store  new member of the organization
     *
     * @param  Request $request
     * @return Illuminate\Response
     */
    public function storeNewMember(Request $request)
    {
      # make sure a user is Login
      parent::loginCheck();

      # make the user is an adviser
      $this->osa_personnel->isOsaPersonnel();

      $org = OrganizationGroup::where('user_id','=', $request->user_id)->get();

      # Return when the user already has a request
      if ($org->count() > 0) {
        return redirect()
        ->route('org-head.members.add')
        ->with('status_warning', 'The user is already a  member or sent a request for membership');
      }

      # Get the organization of the loggedin user
      $org = OrganizationGroup::where('user_id', '=', Auth::user()->id)->get();

      if ($org->count() > 0) {
        $org = $org[0];
      }

      # Store new request
      $result = $request->only('user_id', 'position_id');
      $result['organization_id']   = $org->organization_id;
      $result['membership_status'] = "yes";

      if ($org->count() != 0 ) {
        $result = OrganizationGroup::create( $result );

        # notify the user what happend
        if ($result->wasRecentlyCreated) {
          return redirect()
            ->route('org-head.members.add')
            ->with('status', 'Successfully added..');
        }
      }

      return redirect()
        ->route('org-head.members.add')
        ->with('status_warning', 'Membership is not posible for a moment');
    }

    /**
     * Accept request for new members
     *
     * @param Request $data
     * @return void
     */
    public function acceptNewMember(Request $data)
    {
      echo "wala pa ni";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Check wether this member currently loggedin
     * already requested membership for the organization
     *
     * # Issue: 43 - This method can comnine with _isAmember()
     *
     * @param  int  $id Organization ID
     * @return boolean
     */
    private function _isAlreadyRequested($id)
    {
      $result =  OrganizationGroup::where('user_id', '=', Auth::user()->id)
        ->where('organization_id', '=', $id)
        ->where('membership_status', '=', 'no')
        ->get()
        ->count();

      return ($result == 1) ? true : false;
    }
}