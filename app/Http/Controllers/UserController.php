<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

# Apps
use App\Helpers\RandomHelper;
use App\Mail\EmailNotification;
use App\Common\ValidationTrait;
use App\Common\CommonMethodTrait;

#Models
use App\Models\User;
use App\Models\Course;
use App\Models\UserType;
use App\Models\Position;
use App\Models\Organization;
use App\Models\OrganizationGroup;

/**
 * Handle the user related request
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @company DevCaffee
 *
 * @date 09-26-2017
 * @date 10-08-2017 - Updated
 */
class UserController extends Controller
{
    private $validateWho;

    /**
     * Position name keepers
     * @var string
     */
    private $positionName;

    /**
     * Include some traits
     */
    use ValidationTrait;
    use CommonMethodTrait;

    /**
     * Build instance of a class
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display the list of users
     *
     * @return void
     */
    public function index()
    {
      # Get the list of user together with their
      # course, organization and position in an orgainization
      if (! parent::isOsa()) {
        $org_id = OrganizationGroup::with('organization')
          ->where('user_id', Auth::id())
          ->get();

        $users = OrganizationGroup::with([
            'user' => function($query) {
              return $query
                ->with('course')
                ->get();
            },
            'organization', 'position'
          ])->where('organization_id', $org_id[0]->organization_id)
            ->get();
      } else {
        $org_id = null;
        $users  = User::with([
          'course',
          'userType',
          'organizationGroup' => function($query) {
            return $query
              ->with(['position', 'organization'])
              ->get();
          }])->get();
      }

      return view('users_index')
        ->with([
          'users'   => $users,
          'org'     => $org_id,
          'account' => self::whatAccount(),
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
      if (parent::isOsa()) {
        $positions     = Position::all();
        $accounts      = UserType::all();
        $organizations = Organization::all();
      } else {
        $positions = Position::all()
          ->except([2,3]);
      }

      # View
      return view('auth/register')
        ->with([
          'courses'       => Course::all(),
          'accounts'      => UserType::all(),
          'positions'     => $positions,
          'accounts'      => isset($accounts) ? $accounts : null,
          'organizations' => isset($organizations) ? $organizations : null
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
      $user = $request->only([
        'account_number', 'full_name', 'email', 'position_id'
      ]);

      if (parent::isOrgHead()) {
        $user['user_type_id']    = '2';
        $user['organization_id'] = self::extractID(self::getOrganizationsID()); # this is from a CommonMethodTrait
      }

      if (parent::isOsa()) {
        $user['user_type_id']    = $request->user_type_id[$key];
        $user['organization_id'] = $request->organization_id[$key];
      }

      # Return the invalid account number
      if (! preg_match('/^(20[0-9]{2})-([0-9]{5})$/', $user['account_number'])) {
        $user['error']                = true;
        $user['error_account_number'] = $user['account_number'];
        return json_encode($user);
      }

      # return invalid email
      if (! filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $statusNotice        = "The email address {$user['email']} is not valid";
        $user['error']       = true;
        $user['error_email'] = $statusNotice;
        return json_encode($user);
      }

      if (self::emailExists($user) or self::accountExists($user)) {
        $statusNotice        = "The email address or the account number already exist";
        $user['error']       = true;
        $user['error_email'] = $statusNotice;
        return json_encode($user);
      }

      # catch if the position is already taken, the head must assign another position to the user
      if (self::positionIsTaken($user)) {
        $statusNotice = self::getPositionName() . " is already assigned to a member in your organization. " .
          "Please assign other position to " . $user['full_name'] .
          " or reassign the person who is currently " . self::getPositionName() . ".";

        $user['error']          = true;
        $user['error_position'] = $statusNotice;
        return json_encode($user);
      }

      $result = User::create($user);

      if( $result->wasRecentlyCreated ){
        # Get the user created ID
        $user['user_id'] = $result->id;

        # remove from arrays the following
        unset($user['account_number']);
        unset($user['full_name']);
        unset($user['email']);
        unset($user['user_type_id']);
        unset($user['status']);

        OrganizationGroup::create($user);
      }

      $user = [
        'success' => true
      ];
      return json_encode($user);
    }

    public function _store(Request $request)
    {
      $statusNotice = "";
      foreach (self::requestToArray($request) as $key => $user) {
        # catch if the position is already taken, the head must assign another position to the user
        if(self::positionIsTaken($user)) {
          $statusNotice = $statusNotice . " " .
            self::getPositionName() . " is already assigned to a member in your organization. " .
            "Please assign other position to " . $user['full_name'] .
            " or reassign the person who is currently " . self::getPositionName() . ".";
        }

        if (self::emailExists($user) or self::accountExists($user) or self::positionIsTaken($user) ) {
          $userReturn[] = $user;
          if(self::positionIsTaken($user)) {
            $positionTaken = true;
          }
        }
        else {
          $result = User::create($user);

          if( $result->wasRecentlyCreated ){
            $userCreated = true;
          }

          if (isset($user['organization_id'])) {
            # Get the user created ID
            $user['user_id'] = $result->id;

            # remove from arrays the following
            unset($user['account_number']);
            unset($user['full_name']);
            unset($user['email']);
            unset($user['user_type_id']);
            unset($user['status']);

            # get organization ID
            if (is_array($user['organization_id'])) {
              $id_t;
              foreach ($user['organization_id'] as $key => $id) {
                $id_t = $id;
              }
              $user['organization_id'] = $id_t;
            }

            OrganizationGroup::create($user);
          }
        }
      }

      # Used to display the warning error
      if (count($userReturn) > 0) {
        $status = true;
      }
      if( isset($positionTaken) ){
        $status = null;
      }

      return back()
        ->with([
          'status'         => isset($userCreated) ? 'Successfully added user/s' : null,
          'status_position'=> isset($positionTaken) ? 'Position already assigned' : null,
          'status_warning' => isset($status) ? $status : null,
          'status_message' => 'Some of the user are already exists, just assign their positions in your organization',
          'status_notice' => $statusNotice,
          // 'user_return'    =>  $userReturn
        ]);
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
        'userType',
        'organizationGroup' => function($query) {
          return $query
          ->with(['position', 'organization'])
          ->get();
        }
        ]);

        if ($id == 'active') {
          $users = $users->where('status', 'true')
          ->get();
        }
        if ($id == 'inactive') {
          $users = $users->where('status', 'false')
          ->get();
        }

      return view('users_index')->with([
        'users'  => $users,
        'help'   => $help,
        'filter' => true,
        'id'     => $id,
        'account' => self::whatAccount()
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

        # Check the user password from the database
        if (is_null($user->password)) {
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

    /**
     * Assign position
     *
     * @param  Request $request
     * @return
     */
    public function assignPositionToExistingUser(Request $request)
    {
      $exist_user = json_decode($request->existing_user);
        /**
         * get current user's org id to know what org id to assign to the members being registered
        */
        $current_user_org_g = OrganizationGroup::where('user_id', Auth::user()->id)
          ->where('position_id', 3)
          ->get();

        if( $request->position_id != 1){
          //checks if the position assigned is not 'Not Applicable',
          // because the 'Not Applicable' position can be repeatedly assigned to many users
          $org_grp = OrganizationGroup::where('organization_id', $current_user_org_g[0]->organization->id)
            ->where('position_id', $request->position_id)
            ->get();

          if ($org_grp->count() > 0) {
            return back()
              ->withInput()
              ->with('status_warning', 'Position is already taken');
          }
        }

        $existing = OrganizationGroup::where('organization_id', $current_user_org_g[0]->organization->id)
          ->where('user_id', $exist_user[0]->id)
          ->get()
          ->exists();

        if ( $existing ) {
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

        if ($new_org_member->wasRecentlyCreated) {
          return back()
          ->withInput()
          ->with('status', 'Successfully added new user');
        }
    }

    /**
     * Upload new profile picture
     *
     * @param  Request $request
     * @return Illuminate\Response
     */
    public function uploadProfilePic (Request $request) 
    {
      $this->validate($request, [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      # Get image, rename and save to images folder
      $imageName = time().'.'.$request->image->getClientOriginalExtension();
      $request->image->move(public_path('img/profile'), $imageName);

      # Save to database
      $user          = User::find($request->id);
      $picture       = $user->picture;
      $user->picture = $imageName;

      $user->save();

      # Delete old pic except default
      if (file_exists("img/profile/$picture") and $picture != 'profile.png') {
        unlink("img/profile/$picture");
      }

      $sucessOrFailed = "Image Uploaded successfully.";

      # Return to uploader page
      return back()
        ->with('status', $sucessOrFailed);
    }

    /**
     * Organization member
     *
     * @param  [type] $orgId [description]
     * @return [type]        [description]
     */
    public function orgMembers($orgId)
    {
      $users = OrganizationGroup::with('user')
          ->with('organization')
          ->with('position')
          ->where('organization_id', $orgId)
          ->get();

      $organizations = Organization::find($orgId);

      return view('users_index')
        ->with([
          'users' => $users,
          'org'   => $organizations
        ]);
    }

    /**
     * Convert the request to array
     *
     * @param  object $request
     * @return array
     */
    private function requestToArray($request)
    {
      $data = [];
      foreach ($request->all()['account_number'] as $key => $account_number) {
        $data[$key] = [
          'account_number' => $account_number,
          'position_id'    => $request->position_id[$key],
          'full_name'      => $request->full_name[$key],
          'email'          => $request->email[$key],
        ];

        if (parent::isOrgHead()) {
          $data[$key]['user_type_id']    = '2';
          $data[$key]['organization_id'] = self::getOrganizationsID(); # this is from a CommonMethodTrait
        }

        if (parent::isOsa()) {
          $data[$key]['user_type_id']    = $request->user_type_id[$key];
          $data[$key]['organization_id'] = $request->organization_id[$key];
        }
      }

      return $data;
    }

    /**
     * return true if the email exists in the database
     *
     * @param  array $user
     * @return boolean
     */
    private function emailExists(&$user)
    {
      $count = User::where('email', $user['email'])
        ->get()
        ->count();

      if ($count > 0) {
        return true;
      }

      return false;
    }

    /**
     * Return true if the account exists
     *
     * @param array $user
     * @return boolean
     */
    private function accountExists(&$user)
    {
      $count = User::where('account_number', $user['account_number'])
        ->get()
        ->count();

      if ($count > 0) {
        return true;
      }

      return false;
    }

    /**
     * Determine whether the chosen position is already
     * taken in an organization
     *
     * @param  object $user
     * @return boolean
     */
    private function positionIsTaken(&$user)
    {
      $position = OrganizationGroup::with('position')
        ->where('position_id', $user['position_id'])
        ->where('organization_id', self::getOrganizationsID())
        ->get();

      if ($position->count() > 0) {
        $this->positionName = $position[0]->position->name;
        return true;
      }

      return false;
    }

    /**
     * Return the position name
     * @return [type] [description]
     */
    private function getPositionName()
    {
      return $this->positionName;
    }

    public function changePassword(Request $request)
    {
      // d($request); exit;
      $user = User::find(Auth::id());
      if (Hash::check($request->old_password, $user->password))
      {
          if( $request->new_password == $request->confirm_password ) {
            $user->password = bcrypt($request->new_password);

            $request->email    = $user->email;
            $request->password = $request->new_password;

            Mail::to($user->email)->send(new EmailNotification($request));

            $user->save();
            return back()->with('status_warning', 'successfully changed password');
          } else {
            return back()->with('status_warning', 'new password and confirm password doesn\'t match');
          }
      } else {
            return back()->with('status_warning', 'old password is incorrect');
      }
    }

    /**
     * Determin the user type
     *
     * @return
     */
    private function whatAccount()
    {
      if (parent::isOsa()) {
        return 'osa';
      }
      if (parent::isOrgHead()) {
        return 'org-head';
      }
      if (parent::isOrgMember()) {
        return 'org-member';
      }
    }
}
