<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

# Apps
use App\Helpers\RandomHelper;
use App\Mail\EmailNotification;
use App\Common\ValidationTrait;

#Models
use App\Models\User;
use App\Models\Course;
use App\Models\UserType;
use App\Models\Position;
use App\Models\OrganizationGroup;

/**
 * Handle the user related request
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @company DevCaffee
 * @date 09-26-2017
 * @date 10-08-2017 - Updated
 */
class UserController extends Controller
{
    private $validateWho;

    use ValidationTrait;

    /**
     * Initial instance of the class
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RandomHelper $help)
    {
      # Get the list of user together with their
      # course, organization and position in an orgainization
      $users = User::with([
        'course',
        'organizationGroup' => function($query) {
          return $query->with(['position', 'organization'])->get();
        }
      ])->where('status', 'true')
        ->get();

      return view('users_index')->with([
        'users'      => $users,
        'help'       => $help
      ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      # Determine if OSA

      # View
      return view('auth/register')->with([
        'courses'    => Course::all(),
        'accounts'   => UserType::all(),
        'positions'   => Position::all()->except(2)->except(5)->except(7)->except(3)
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // d($request); exit;
      // $this->validateUser($this, $request); ///  FIX VALIDATION LATER

      $u   = [];
      $pos = [];
      for($x = 0; $x <= sizeof($request->keys()[1]); $x++){
        //store every user record detail from form/s except the position in an array,
        // then assign its user_type_id to 2 (for organization-member user type) 
        $u[$x] = [
          'full_name'      => $request->full_name[$x],
          'account_number' => $request->account_number[$x],
          'email'          => $request->email[$x],
          'user_type_id'    => 2,
        ];
        $pos[$x] = $request->position_id[$x]; 
        //store each user position record in a separate array
        //separating this since this field is availale in Organizaition Group model

        $user_email = User::where('email', $u[$x]['email'])->get();
        //searching an instance of User model with the current record of email in the array, and if exists, store it to a variable
        $user_acc_num = User::where('account_number', $u[$x]['account_number'])->get();
        //searching an instance of User model with the current record of account_number in the array, and if exists, store it to a variable

        if ($user_email->count() > 0) { 
          //checking if the instance with the email record already exists
          //and will return to the form to ask user to input other email
          return back()
            ->withInput() 
            ->with('status_warning', 'Email already taken in the system');
        }
        if ($user_acc_num->count() > 0) {
          //checking if the instance with the account_number record already exists
          //if exists, the user will only be assigning a position to the organization-member and 
          //the system will store another instance in OrganizationGroup with the user_id of the org-member and
          // the current user's organization_id  
          return view('assign_position')
          ->with([ 'existing_user' =>  $user_acc_num, 'positions' => Position::all()->except(2)->except(5)->except(7)->except(3)])
          ->with('status_warning', 'Student' . $user_acc_num[0]['full_name'] . 'is already a user of the system, assign this member a position in your organization.');
          ///NGANO DILI MUDISPLAY ANG STATUS_WARNING?          
        }

        //if there are no duplicates of records for email or account number, system stores this new instance of User model
        $new_user = User::create( $u[$x] );

        /**
         * get current user's org id to know what org id to assign to the members being registered
         */
        $current_user_org_g = OrganizationGroup::where('user_id', Auth::user()->id)->where('position_id', 3)->get();
        // dd($current_user_org_g[0]->organization->id);

        if( $pos[$x] != 1){ 
          //filters if the position assigned is not 'Not Applicable', because 'Not Applicable' position can be repeatedly assigned to many users
          $org_grp = OrganizationGroup::where('organization_id', $current_user_org_g[0]->organization->id)->where('position_id', $pos[$x])->get();
          if ($org_grp->count() > 0) {
          //checks if the position in an organization has been assigned to someone
            return back()
              ->withInput()
              ->with('status_warning', 'Position is already taken');
          } 
        }

        if (OrganizationGroup::where('organization_id', $current_user_org_g[0]->organization->id)->where('user_id', $new_user->id)->get()->exists()) {
            //checks if the user record is already a member of the org
            return back()
              ->withInput()
              ->with('status_warning', 'The user is already a member of this organization');
        } 

        //if user record is not already a member or the position assigned in the organization is not taked,
        //system created new instance of OrganizationGroup
         $new_org_member = OrganizationGroup::create([
           'user_id'         => $new_user->id,
           'organization_id' => $current_user_org_g[0]->organization->id,
           'position_id'     => $pos[$x],
         ]); 

         d($new_user, $new_org_member);
      }
      
      exit;


      if ($user->wasRecentlyCreated) {
        return back()
          ->withInput()
          ->with('status', 'Successfully added new user');
      }


      // Issue 24
      // $password          = str_random(15);
      // $request->password = $password;

      // Mail::to($request->email)->send(new EmailNotification($request));

      # Validate sah

      # save sa database
      // $data = $request->all();
      // $data['password'] = bcrypt($password);

      // $user = User::create( $data );
      $user = User::create( $data );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, RandomHelper $help)
    {
      # Get the list of user together with their
      # course, organization and position in an orgainization
      $users = User::with([
        'course',
        'organizationGroup' => function($query) {
          return $query->with(['position', 'organization'])->get();
        }
      ]);

      if ($id == 'active') {
        $users = $users->where('status', 'true')->get();
      }
      if ($id == 'inactive') {
        $users = $users->where('status', 'false')->get();
      }

      return view('users_index')->with([
        'users'  => $users,
        'help'   => $help,
        'filter' => true
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return json_encode([
        'user'      => User::find($id)->toArray(),
        'course'    => Course::all()->toArray(),
        'user_type' => UserType::all()->toArray(),
      ]);
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
      $user = User::find($id);

      if (isset($request->from_modal_user_edit)) {
        $user->full_name      = empty($request->full_name) ? $user->full_name : $request->full_name;
        $user->account_number = empty($request->account_number) ? $user->account_number : $request->account_number;
        $user->course_id      = empty($request->course_id) ? $user->course_id : $request->course_id;
        $user->user_type_id   = empty($request->user_type_id) ? $user->user_type_id : $request->user_type_id;
      } else {
        $user->status = $request->status;

        if ($user->password == null) {
          $password          = str_random(15);
          $request->password = $password;
          
          $request->email = $user->email;
          Mail::to($user->email)->send(new EmailNotification($request));
          
          $user->password = bcrypt($password);
        }
      }

      if ($user->save()) {
        return back()
          ->with('status', 'Successfully change the status');
      }
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

    public function assignPositionToExistingUser(Request $request){
      // d((json_decode($request->existing_user))->id); exit;
      // d($request->position_id); exit;
        /**
         * get current user's org id to know what org id to assign to the members being registered
        */
        $current_user_org_g = OrganizationGroup::where('user_id', Auth::user()->id)->where('position_id', 3)->get();
        // dd($current_user_org_g[0]->organization->id);

        if( $request->position_id != 1){ 
          //checks if the position assigned is not 'Not Applicable',
          // because the 'Not Applicable' position can be repeatedly assigned to many users
          $org_grp = OrganizationGroup::where('organization_id', $current_user_org_g[0]->organization->id)->where('position_id', $request->position_id)->get();
          // d($org_grp); exit;
          if ($org_grp->count() > 0) {
          //checks if the position in an organization has been assigned to someone
            return back()
              ->withInput()
              ->with('status_warning', 'Position is already taken');
          } 
        }


        if (OrganizationGroup::where('organization_id', $current_user_org_g[0]->organization->id)->where('user_id', (json_decode($request->existing_user))->id)->get()->exists()) {
            //checks if the user record is already a member of the org
            return back()
              ->withInput()
              ->with('status_warning', 'The user is already a member of this organization');
        } 
         
        //if user record is not already a member or the position assigned in the organization is not taked,
        //system created new instance of OrganizationGroup
         $new_org_member = OrganizationGroup::create([
           'user_id'         => (json_decode($request->existing_user))->id,
           'organization_id' => $current_user_org_g[0]->organization->id,
           'position_id'     => $request->position_id,
         ]); 

    }
}
