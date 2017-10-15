<?php

namespace App\Http\Controllers;

use Auth;
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
 * @date 09-26-2017
 * @date 10-08-2017 - Updated
 */
class UserController extends Controller
{
    private $validateWho;

    use ValidationTrait, CommonMethodTrait;

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
      ])->get();

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
      if (parent::isOsa()) {
        $positions     = Position::all();
        $accounts      = UserType::all();
        $organizations = Organization::all();
      } else {
        $positions = Position::all()
          ->except([2,3,4,5,6,7]);
      }

      # View
      return view('auth/register')->with([
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
      $userReturn = [];

      foreach (self::requestToArray($request) as $key => $user) {
        if (self::emailExists($user) or self::accountExists($user)) {
          $userReturn[] = $user;
        } else {
          $result = User::create($user);

          if (isset($user['organization_id'])) {
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
        }
      }

      # Used to display the warning error
      if (count($userReturn) > 0) {
        $status = true;
      }

      return back()
        ->with([
          'status'         => 'Successfully added users',
          'status_warning' => isset($status) ? $status: null,
          'status_message' => 'Some of the user are already exists, either an email or account number',
          'user_return'    => $userReturn
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
        'organizationGroup' => function($query) {
          return $query->with(['position', 'organization'])
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
        'id'     => $id
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

    public function assignPositionToExistingUser(Request $request){
      // d((json_decode($request->existing_user))->id); exit;
      $exist_user = json_decode($request->existing_user);
      // d($exist_user[0]->id); exit;
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


        if ( OrganizationGroup::where('organization_id', $current_user_org_g[0]->organization->id)->where('user_id', $exist_user[0]->id)->get()->exists() ) {
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

        if ($new_org_member->wasRecentlyCreated) {
          return back()
          ->withInput()
          ->with('status', 'Successfully added new user');
        }
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
          $data[$key]['organization_id'] = self::getOrganization(); # this is from a CommonMethodTrait
        }

        if (parent::isOsa()) {
          $data[$key]['user_type_id']    = $request->user_type_id[$key];
          $data[$key]['organization_id'] = $request->organization_id[$key];
          $data[$key]['status']          = 'true';
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
}
